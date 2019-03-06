<?php

namespace DDApp\Http\Controllers\OrderReceive;

use Illuminate\Http\Request;
use Illuminata\Support\Facades\Auth;
use DDApp\Http\Controllers\Controller;
use DDApp\Model\OrderReceive\Orderdocument;
use DDApp\Model\OrderReceive\Stockitem;
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
        $orderdocuments = Orderdocument::all();
        $docids = [];
        foreach ($orderdocuments as $orderdocument) {
            if(!in_array($orderdocument->doc_id, $docids)){
                $docids[] = $orderdocument->doc_id;
            }
        }
        if(in_array($request->doc_id, $docids)){
            \Session::flash('e_flash_message', '同じ発注IDは既に使用されました。');
            return redirect()->route('order_receive::orderdocuments.index');
        }

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
                    if($row['parent_sku'] == NULL) continue;
                    if($row['parent_num'] == NULL) $row['parent_num'] = 0;

                    $item = Orderdocument::firstOrCreate([
                        'doc_id' => $doc_id,
                        'order_date' => $order_date,
                        'parent_sku' => $row['parent_sku'],
                        'parent_num' => $row['parent_num'],
                        'supplier' => $row['supplier'],
                        'price' => $row['price'],
                        'warehouse' => $row['warehouse'],
                        'product_place' => $row['product_place'],
                        'memo'=>$row['memo'],
                        'done' => false,
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
            \Session::flash('e_flash_message', $e);
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

    public function select(Request $request){
        return $request;
    }
    public function edit(Request $request){
        return $request;
    }
}
