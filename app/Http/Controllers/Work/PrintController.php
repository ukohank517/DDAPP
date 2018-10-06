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
	    'boxname'=>'required',
	    'page'=>'required',
	]);
	
	$boxname = $request->boxname;
	$page = $request->page;
	if(in_array("greenlabel", $page)){
	    \Session::flash('greenlabel_flag', 'flag');
	}
	if(in_array("invoice", $page)){
	    \Session::flash('invoice_flag', 'flag');
	}

        return view('print', compact('boxname'));
    }
    
    public function ppppppppppprint(){
	// PDFドキュメントを生成
	//$pdf = new PdfDocument();
	$pdf = PdfDocument::load("sample.pdf");
	// A4サイズでPDFのページを生成
	//$pdfPage = new Page(Page::SIZE_A4);
	$pdfPage = $pdf->pages[0];
	//$pdfPage->rotate(100,800,3.14*0.5);
	// 日本語のフォントを指定
	$font = Font::fontWithPath('fonts/HanaMinA.ttf');
	// フォントと文字のサイズを指定
	$pdfPage->setFont($font, 24);
	// 出力する文字と位置、文字コードの設定
	$pdfPage->drawText('(100,600)ZendPDFでPDFF生成', 100, 600, 'UTF-8');
	//$pdfPage->drawText('(100,800)ZendPDFでPDFF生成', 100, 800, 'UTF-8');
	
	// 生成したページをPDFドキュメントに追加
	$pdf->pages[] = $pdfPage;
	//ファイルとして保存、ブラウザに出力
	//$pdf->save('sample.pdf');
	header('Content-Type:', 'application/pdf');
	header('Content-Disposition:', 'inline;');
	echo $pdf->render();

	return "hello";
    }


}

