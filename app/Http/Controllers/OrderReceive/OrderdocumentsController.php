<?php

namespace DDApp\Http\Controllers\OrderReceive;

use Illuminate\Http\Request;
use Illuminata\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Orderdocument;
use Excel;

class OrderdocumentsController extends Controller
{
    public function index()
    {
        $orderdocuments = Orderdocument::paginate(15);
        return view('order_receive.orderdocuments.upload', compact('orderdocuments'));
    }


    public function upload(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required|mimes:xlsx,txt|max:1500'
        ]);

        $file = $request->file('csv_file');

        // ファイルの読み込み
        try{
            $reader = Excel::load($file->getRealPath());
            if($reader == null)
            {
                throw new \Exception('読めませんでした。');
                return "error1";
            }

            if(preg_match('/SheetCollection$/', get_class($reader->all())))
            {
                // シートが複数
                $sheet = $reader->first();
            }
            else if(preg_match('/RowCollection$/', get_class($reader->all())))
            {
                // シートが一枚
                $sheet = $reader;
            }
            else
            {
                throw new \Exception('予期せぬエラー。');
            }
        }
        catch(\Exception $e){
            return $e;
        }
        try{
            $rows = $sheet->toArray();

            $doc_id = $request->doc_id;
            $order_date = $request->order_date;

            if(count($rows)){
                foreach ($rows as $row) {
                    if($row['parent_num'] == NULL) continue;
                    if($row['parent_sku'] == NULL) continue;

                    $item = Orderdocument::firstOrCreate([
                        'doc_id' => $doc_id,
                        'order_date' => $order_date,
                        'parent_sku' => $row ['parent_sku'],
                        'parent_num' => $row['parent_num'],
                        'supplier' => $row['supplier'],
                        'price' => $row['price'],
                    ],[
                    ]);
                    $items[] = $item;
                    continue;
                }
            }
            foreach($items as $item){
                $item->save();
            }

            \Session::flash('flash_message', '更新しました。');
            return redirect()->route('order_receive::orderdocuments.index');
        }
        catch(\Exception $e){
            \Session::flash('e_flash_message', '更新時エラーが発生しました');
            return redirect()->route('order_receive::orderdocuments.index');
        }

    }

    public function download(){
        $orderdocuments = Orderdocument::get()->toArray();
        return \Excel::create('orderdocument', function($excel) use ($orderdocuments) {
            $excel->sheet('sheet', function($sheet) use ($orderdocuments)
            {
                $sheet->fromArray($orderdocuments);
            });
        })->download('xlsx');
    }

    public function confirm(){
        $orderdocuments = Orderdocument::paginate(15);
        return view('order_receive.orderdocuments.confirm', compact('orderdocuments'));
    }
}
