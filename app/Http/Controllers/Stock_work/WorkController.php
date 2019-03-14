<?php

namespace DDApp\Http\Controllers\Stock_work;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Orderdocument;
use DDApp\Model\OrderReceive\stockitem;
use DDApp\Model\OrderReceive\itemrelation;
use DDApp\Ordersheet;

class WorkController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
    * 作業ページ
    * ログインuserの処理している内容を表示する。
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        $zero_ignore = "false";
        $former_sku = "";
        $skuinfo ="";
        $stocknums = "";
        $selfitem = self::selfbox();
        return view('stock_work.work', compact('zero_ignore', 'former_sku', 'skuinfo', 'stocknums', 'selfitem'));
    }


    public function deal_and_recommend(Request $request){
        $zero_ignore = $request->zero_ignore;
        $former_sku = $request->former_sku;
        $ans = self::search_helper($request);

        $ordersheets = $ans[0];
        $former_sku = $ans[1];

        $skuinfo = self::skuinfo($former_sku);
        $stocknums = self::stocknum($skuinfo);

        $selfitem = self::selfbox();
        if(count($selfitem)==0)$selfidx = 0;
        else $selfidx = $selfitem[0]->id_in_box;

        if($request->deal_ids !=null){
            foreach($request->deal_ids as $id){
                //検索する内容
                $hit_item = Ordersheet::where('id', $id)->first();
                //この内容と同じ注文番号のものをhit_itemsに
                $hit_items=array();
                if($hit_item->plural_marker != null){
                    $hit_items = Ordersheet::where('plural_marker', $hit_item->plural_marker)->get();
                }else{
                    $hit_items[] = $hit_item;
                }
                //これらをすべてboxに入れておく、idx+1
                $selfidx = $selfidx + 1;
                foreach($hit_items as $item){
                    if($item->id_in_box != 0) continue;
                    $item->box = "floor_three";
                    $item->id_in_box = $selfidx;
                    $item->save();
                }
            }
        }

        $selfitem = self::selfbox();
        return view('stock_work.recommend', compact('ordersheets', 'zero_ignore', 'former_sku', 'skuinfo', 'stocknums', 'selfitem'));
    }

    private static function stocknum($skuinfo){
        $ret = array();
        if($skuinfo == null) return null;

        foreach($skuinfo as $item){
            $stockitem = Stockitem::where('parent_sku', $item->parent_sku)->first();
            if($stockitem != null){
                $ret[$item->parent_sku] = $stockitem->stock_num;
            }else{
                $ret[$item->parent_sku] = "no information";
            }
        }
        return $ret;

    }

    private static function skuinfo($sku){
        $itemrelations = Itemrelation::where('child_sku', $sku)->get();
        $ret = array();
        $skulist = array();

        foreach($itemrelations as $item){
            if(in_array($item->parent_sku, $skulist)){
                continue;
            }else{
                $skulist[] = $item->parent_sku;
                $ret[] = $item;
            }
        }

        return $ret;
    }

    private static function selfbox(){
        $ordersheets = Ordersheet::where('box', 'floor_three')->orderBy('id_in_box', 'desc')->get();
        return $ordersheets;
    }

    private static function search_helper($request){
        $zero_ignore = $request->zero_ignore;
        $former_sku = $request->former_sku;

        $ordersheets = Ordersheet::where('stock_stat', ['在庫'])->whereNull('box')->get();

        $skulists = array();

        foreach($ordersheets as $item){
            if(in_array($item->sku, $skulists)) continue;
            $skulists[] = $item->sku;
        }
        if(count($skulists) == 0 || $former_sku == "FINISH"){
            $former_sku = "FINISH";
            $ans[] = $ordersheets;
            $ans[] = $former_sku;
            return $ans;
        }

        if($former_sku == null)  $former_sku = $skulists[0];
        else if($former_sku == $skulists[count($skulists)-1]){
            // すべてが検索終了処理！！！
            $former_sku = "FINISH";
        }
        else{
            for($i = 0; $i < count($skulists); $i++){
                if($skulists[$i] == $former_sku){
                    $former_sku = $skulists[$i + 1];
                    break;
                }
            }
        }

        $items = Ordersheet::where('stock_stat', '在庫')->where('sku', $former_sku)->whereNull('box')->get();

        $ordersheets = array();

        foreach($items as $item){
            if($item->plural_marker!=null){
                $ordersheet = Ordersheet::where('plural_marker', $item->plural_marker)->get();
            }else{
                $ordersheet = Ordersheet::where('id', $item->id)->get();
            }
            $ordersheets[] = $ordersheet;
        }

        $ans[] = $ordersheets;
        $ans[] = $former_sku;
        return $ans;
    }

}
