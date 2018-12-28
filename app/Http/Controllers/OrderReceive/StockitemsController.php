<?php

namespace DDApp\Http\Controllers\OrderReceive;

use Illuminate\Http\Request;
use Illuminata\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Stockitem;
use Excel;

class StockitemsController extends Controller
{
    public function index()
    {
        $stockitems = Stockitem::paginate(15);
        $edit_id = -1;
        return view('order_receive.stockitems.index', compact('stockitems', 'edit_id'));
    }


    public function select(Request $request){
        $stockitems = Stockitem::paginate(15);
        $edit_id = $request->edit_id;
        $edit_data = Stockitem::where('id',$edit_id)->first();
        return view('order_receive.stockitems.index', compact('stockitems', 'edit_id', 'edit_data'));
    }

    public function edit(Request $request){
        $stock = Stockitem::where('id', $request->edit_id)->first();
        $stock->price = $request->price;
        $stock->place = $request->place;
        $stock->memo = $request->memo;
        $stock->save();

        \Session::flash('success_msg', '更新が完了しました。');
        return redirect()->route('order_receive::stockitems.index');
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
