<?php

namespace DDApp\Http\Controllers\Stock_work;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;

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
        return view('stock_work.work');
    }

    public function recommend(Request $request){
        return $request;
    }

}
