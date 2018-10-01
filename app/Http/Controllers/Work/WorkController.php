<?php

namespace DDApp\Http\Controllers\Work;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Ordersheet;
use DDApp\Param;
use DDApp\Skutransfer;
use DDApp\Zonecode;


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
    * Show the work page
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        $box_name = Auth::user()->dealing_box_name;
	$dealing_items = Ordersheet::where('box', $box_name)
		       ->orderBy('id_in_box', 'desc')
		       ->get();

		       
        /*
        if(count($dealing_items)!=0){
	    $max_goods_in_box = Param::where('param_name', 'max_box_name')->first();
	    if($dealing_items[0]->id_in_box == $max_goods_in_box->value){
	        //\Session::flash('full_flag', 'flag');
		//return "yes";
	    }
	}
	*/
        return view('work.work', compact('box_name','dealing_items'));
    }


    public function selfbox(){ 
        $box_name = Auth::user()->dealing_box_name;
	$item = Ordersheet::where('box', $box_name)->get();

	return $item;
    }



    public function delete_last_line(){
    	$box_name = Auth::user()->dealing_box_name;
	$dealing_items = Ordersheet::where('box', $box_name)
		       ->orderBy('id_in_box', 'desc')
		       ->get();
	
	if(count($dealing_items)!=0){
	
	    $last_item_no = $dealing_items[0]->id_in_box;
	    $last_items = Ordersheet::where('box', $box_name)->where('id_in_box', $last_item_no)->get();
	    
	    foreach($last_items as $last_item){	
	        // ラストNOの処理痕跡を削除
	        $last_item -> box = null;
	        $last_item -> wait_box = null;
	        $last_item -> stock_num = 0;
	        $last_item -> save();
	    }
	    \Session::flash('flash_message', '最終行削除しました。行番号:['.$last_item->line
							         .'],sku:['.$last_item->sku
							         .'],注文番号:['.$last_item->order_id
							         .']');
	}
	return redirect()->route('work::work');
    }

}

