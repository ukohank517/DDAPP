<?php

namespace DDApp\Http\Controllers\OrderReceive;

use Illuminate\Http\Request;
use Illuminata\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Stockitem;
use Excel;

class StockitemsController extends Controller
{
    public function index(Request $request)
    {
        if($request->search_sku == null){
            $stockitems = Stockitem::paginate(15);
            $edit_id = -1;

        }else{
            $stockitems = Stockitem::where('parent_sku', $request->search_sku)->paginate(15);
            $edit_id = -1;
        }
        return view('order_receive.stockitems.index', compact('stockitems', 'edit_id'));
    }


    public function select(Request $request){
        $stockitems = Stockitem::paginate(15);
        $edit_id = $request->edit_id;
        $edit_data = Stockitem::where('id',$edit_id)->first();
        return view('order_receive.stockitems.index', compact('stockitems', 'edit_id', 'edit_data'));
    }

    public function edit(Request $request){
        $request->validate([
            'num'=>'integer',
            'price'=>'integer|nullable',
        ]);

        $stock = Stockitem::where('id', $request->edit_id)->first();
        $stock->stock_num = $request->num;
        $stock->price = $request->price;
        $stock->place = $request->place;
        $stock->memo = $request->memo;
        $stock->save();

        \Session::flash('success_msg', '更新が完了しました。');
        return redirect()->route('order_receive::stockitems.index');
    }

    public function test(Request $request){

        return $request;
    }
    public function download(){
        $itemborders = Itemborder::get()->toArray();
        return \Excel::create('itemborder', function($excel) use ($itemborders) {
            $excel->sheet('sheet', function($sheet) use ($itemborders)
            {
                $sheet->fromArray($itemborders);
            });
        })->download('xlsx');
    }
}
