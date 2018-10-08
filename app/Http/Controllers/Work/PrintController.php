<?php

namespace DDApp\Http\Controllers\Work;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Ordersheet;
use DDApp\Param;
use DDApp\Skutransfer;
use DDApp\Zonecode;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;

class PrintController extends Controller
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
        return view('print');
    }



    public function print(Request $request){
        $request->validate([
	    'box_name'=>'required',
	    'page'=>'required',
	]);
	
	$box_name = $request->box_name;
	$page = $request->page;

	$items = Ordersheet::where('box', $box_name)
	       ->orderBy('id_in_box', 'asc')
	       ->get();

	if(in_array("greenlabel", $page)){
	    \Session::flash('greenlabel_flag', 'flag');	    
	    $this->make_greenlabel($box_name);
	}
	if(in_array("invoice", $page)){
	    \Session::flash('invoice_flag', 'flag');
	    $this->make_invoice($box_name);
	}
	

        return view('print', compact('box_name', 'items'));
    }
    


    public function make_greenlabel($box_name){
        $filename = "greenlabel.pdf";
        \File::delete($filename);
        $pdf = new PdfDocument();
	$width = 215.5;
	$height = 305.5;

	$items = Ordersheet::where('box', $box_name)
	       ->orderBy('id_in_box', 'asc')
	       ->get();

	for($page = 0; $page < $items[count($items)-1]->id_in_box / 8 ;$page++){
	    $pdfPage = new Page(Page::SIZE_A4_LANDSCAPE);
	    //$pdfPage->rotate(0,0, M_PI*0.5);
	    $font = Font::fontWithPath('fonts/HanaMinA.ttf');
	    $pdfPage->setFont($font, 8);
	    for($i = 0; $i < 4; $i=$i+1){
	        for($j = 0; $j< 2; $j=$j+1){
		    $starti = $i * $width;
		    $startj = $j * $height;
		    
	            $item = Ordersheet::where('box', $box_name)
	                       ->where('id_in_box', $page*8+$i*2+$j+1)
	                       ->get();
		    if(count($item) == 0) break;
		    $names = explode("(", $item[0]->goods_name);
		    
		    $num = 0;
		    foreach($item as $de){
		        $num += $de->aim_num;
		    }
		    $totalprice = (int)(10/$num) * $num;



		    $pdfPage->drawText(substr($names[0], 0, 20), $starti+28, $startj+119, 'UTF-8');
		    if(count($names)>=2){
		        $namestr = explode(")",$names[1]);
			$pdfPage->drawText('('.$namestr[0].')', $starti+28, $startj+105, 'UTF-8');
		    }
		    $pdfPage->drawText('g', $starti+112, $startj+101, 'UTF-8');
		    $pdfPage->drawText('USD', $starti+134.4, $startj+119, 'UTF-8');
		    $pdfPage->drawText($totalprice, $starti+134.4, $startj+105, 'UTF-8');
		    $pdfPage->drawText('g', $starti+100, $startj+64, 'UTF-8');
		    $pdfPage->drawText('USD', $starti+159.6, $startj+60, 'UTF-8');
		    $pdfPage->drawText($totalprice, $starti+159.6, $startj+70, 'UTF-8');
		    $pdfPage->drawText($page*8+$i*2+$j+1, $starti+34, $startj, 'UTF-8');
		    $pdfPage->drawText(date("Y/m/d")."   Manabu Hano", $starti+84, $startj, 'UTF-8');
		}
	    }
	    $pdf->pages[] = $pdfPage;
	}

	$pdf->save($filename);
    }
    
    public function make_invoice($box_name){
        $filename = "invoice.pdf";
        \File::delete($filename);

	$pdf = PdfDocument::load("pic/invoice_base.pdf"); // PDFドキュメント作成
	$template = $pdf->pages[0]; 

	
	$items = Ordersheet::where('box', $box_name)
	       ->orderBy('id_in_box', 'desc')
	       ->get();
	for($idx = 0; $idx < 1; $idx++){
	    $pdfPage = new Page($template);
	    //$pdfPage = new Page(Page::SIZE_A4_LANDSCAPE);
	    $font = Font::fontWithPath('fonts/HanaMinA.ttf');// 日本語も使用可能のフォント
	    $pdfPage->setFont($font, 9);          //フォント設定
	    
	    $item = Ordersheet::where('box', $box_name)
	                       ->where('id_in_box', $idx+1)
	                       ->get();
	
            $num = 0;
	    foreach($item as $de){
	        $num += $de->aim_num;
	    }
	    $singleprice = (int)(10/$num); 
	    $totalprice = $singleprice * $num;
	    


            // left up
	    $pdfPage->drawText($item[0]->customer_name, 30, 545, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress1, 30, 530, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress2, 30, 520, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress3, 30, 510, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress4, 30, 500, 'UTF-8');
	    
	    $pdfPage->drawText($item[0]->postid, 55, 467, 'UTF-8');
	    $pdfPage->drawText($item[0]->country, 35, 451, 'UTF-8');
	    $pdfPage->drawText($item[0]->phone_number, 45, 434, 'UTF-8');

	    // left down
	    $pdfPage->drawText($item[0]->customer_name, 25, 275, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress1, 25, 260, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress2, 25, 250, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress3, 25, 240, 'UTF-8');
	    $pdfPage->drawText($item[0]->adress4, 25, 230, 'UTF-8');

	    $pdfPage->drawText($item[0]->phone_number, 40, 217, 'UTF-8');

	    // right up
    	    $pdfPage->drawText($item[0]->line.'~'.$item[count($item)-1]->line, 235, 419, 'UTF-8');
	    $pdfPage->drawText($idx+1, 375, 419, 'UTF-8');
	    $pdfPage->drawText(date('Y/m/d'), 345, 399, 'UTF-8');


	    $pdfPage->setFont($font, 16);          //フォント設定
	    $pdfPage->drawText($item[0]->sendway, 185, 419, 'UTF-8');
	    $pdfPage->drawText($item[0]->sendway, 230, 315, 'UTF-8');

	    // detail
	    $pdfPage->setFont($font, 8);          //フォント設定
	    $pdfPage->drawText($item[0]->goods_name, 30, 133, 'UTF-8');
	    $pdfPage->drawText($num, 280, 133, 'UTF-8');
	    $pdfPage->drawText($singleprice, 320, 133, 'UTF-8');
	    $pdfPage->drawText($totalprice, 370, 133, 'UTF-8');

	    $pdfPage->drawText($totalprice, 370, 63, 'UTF-8');

	    $pdf->pages[] = $pdfPage;
	}

	unset($pdf->pages[0]);
	$pdf->save($filename);
    }





}

