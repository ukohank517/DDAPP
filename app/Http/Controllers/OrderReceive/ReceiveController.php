<?php

namespace DDApp\Http\Controllers\OrderReceive;

use Illuminate\Http\Request;
use Illuminata\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Orderdocument;
use DDApp\Model\OrderReceive\Stockitem;
use Excel;

class ReceiveController extends Controller
{
    public function index()
    {
        return view('order_receive.receive.documentsearch');
    }



}
