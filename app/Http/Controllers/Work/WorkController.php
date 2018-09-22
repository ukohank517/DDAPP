<?php

namespace DDApp\Http\Controllers\Work;

use Illuminate\Http\Request;
use DDApp\Http\Controllers\Controller;
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
    * Show the work page
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        return view('work');
    }

    public function greet(){
        return "hello";
    }
}
