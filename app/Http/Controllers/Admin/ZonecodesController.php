<?php

namespace DDApp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DDApp\Http\Controllers\Controller;
use DDApp\Zonecode;

class ZonecodesController extends Controller
{
    public function index()
    {
        $zonecodes = Zonecode::paginate(15);
	return view('admin.zonecodes.index', compact('zonecodes'));
    }


    public function upload(Request $request)
    {   
        
        $this->validate($request, [
	    'csv_file' => 'required|mimes:xlsx,txt|max:1000'
	]);
	
	$file = $request->file('csv_file');
	
	// ファイルの読み込み
	$reader = \Excel::load($file->getRealPath())->get();
        $rows = $reader->toArray();
	
        Zonecode::truncate();// DB を clear
	
	
	if(count($rows)){
            foreach ($rows as $row) {
                Zonecode::firstOrCreate($row);
            }
        }
	
	\Session::flash('flash_message', '更新しました。');
	return redirect()->route('admin::zonecodes');
    }
    
    public function download(){
        $zonecode = Zonecode::get()->toArray();
        return \Excel::create('zonecode', function($excel) use ($zonecode) {
            $excel->sheet('sheet', function($sheet) use ($zonecode)
            {
                $sheet->fromArray($zonecode);		
            });
        })->download('xlsx');
    }

}
