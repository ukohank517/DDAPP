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
        return view('stock_work.work', compact('zero_ignore', 'former_sku'));
    }

    public function recommend(Request $request){
        $zero_ignore = $request->zero_ignore;
        $former_sku = $request->former_sku;

        $ordersheets = Ordersheet::where('stock_stat', ['在庫'])->get();

        $skulists = array();

        foreach($ordersheets as $item){
            if(in_array($item->sku, $skulists)) continue;
            $skulists[] = $item->sku;
        }

        if($former_sku == null)  $former_sku = $skulists[0];
        else if($former_sku == $skulists[count($skulists)-1]){
            // すべてが検索終了処理！！！
            $former_sku = "FINNN";

        }
        else{
            for($i = 0; $i < count($skulists); $i++){
                if($skulists[$i] == $former_sku){
                    $former_sku = $skulists[$i + 1];
                    break;
                }
            }
        }

        $ordersheets = Ordersheet::where('stock_stat', '在庫')->where('sku', $former_sku)->whereNull('box')->get();

        //former_sku null ならの処理
        //         \Session::flash('success_msg', '更新が完了しました。');
        return view('stock_work.recommend', compact('ordersheets', 'zero_ignore', 'former_sku'));
    }

}
