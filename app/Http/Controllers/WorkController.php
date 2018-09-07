<?php

namespace DDApp\Http\Controllers;

use Illuminate\Http\Request;

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
}
