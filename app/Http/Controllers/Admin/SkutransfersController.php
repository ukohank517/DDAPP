<?php

namespace DDApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DDApp\Http\Controllers\Controller;
use DDApp\Skutransfer;

class SkutransfersController extends Controller
{
    public function index()
    {
        $skutransfers = Skutransfer::paginate(15);
	return view('admin.skutransfers.index', compact('skutransfers'));
    }


    public function upload(Request $request)
    {   
        
        $this->validate($request, [
	    'csv_file' => 'required|mimes:xlsx,txt|max:5000'
	]);
	
	$file = $request->file('csv_file');
	
	// ファイルの読み込み
	$reader = \Excel::load($file->getRealPath())->get();
        $rows = $reader->toArray();
	
        Skutransfer::truncate();// DB を clear
	
	
	if(count($rows)){
            foreach ($rows as $row) {
                Skutransfer::firstOrCreate($row);
            }
        }
	
	\Session::flash('flash_message', '更新しました。');
	return redirect()->route('admin::skutransfers');
    }
    
    public function download(){
        $skutransfer = Skutransfer::get()->toArray();
        return \Excel::create('skutransfer', function($excel) use ($skutransfer) {
            $excel->sheet('sheet', function($sheet) use ($skutransfer)
            {
                $sheet->fromArray($skutransfer);		
            });
        })->download('xlsx');
    }

}
