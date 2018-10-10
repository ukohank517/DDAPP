<?php

namespace DDApp\Http\Controllers\Work;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Ordersheet;
use DDApp\Param;
use DDApp\Skutransfer;
use DDApp\Zonecode;


class ItemSearchController extends Controller
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
    * 
    * 
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        $request->validate([
	    'year'=>'nullable|integer',
	    'month'=>'nullable|integer',
	    'line'=>'nullable|integer',
	]);


        $year = $request->year;
	$month = $request->month;
	$box = $request->box;
	$sku = $request->sku;
	$line = $request->line;
	$orderid = $request->orderid;

	$query = Ordersheet::query();
	
	if($year!=NULL) $query->whereYear('date', '=', $year);
	if($month!=NULL) $query->whereMonth('date', '=', $month);
	if($box!=NULL) $query->where('box', $box);
	if($sku!=NULL) $query->where('sku', $sku);
	if($line!=NULL) $query->where('line', $line);
	if($orderid!=NULL) $query->where('order_id', $orderid);

	
        $ordersheets = $query->paginate(30);
        return view('work.item_search', compact('ordersheets', 'year', 'month', 'box', 'sku', 'line', 'orderid'));
    }


    public function search(){
    }

}

