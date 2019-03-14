@extends('stock_work.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">在庫品処理ページ</div>
                <div class="card-body">
                    <form action="{{route('stock_work::work.deal_and_recommend')}}">
                        <p><input type ="checkbox" name="zero_ignore" value={{$zero_ignore}}>　0在庫無視</p>
                        <p><input type ="hidden" name="former_sku" value={{$former_sku}}></p>
                        <p><input type="submit" value="システムより提案"></p>
                    </form>
                </div>

                <div class="card-header"><center>BOX中身一覧</center></div>
                <div class="card-body">
                    <div>
                        <table class="table table-striped table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th>id</th>
                                    <th>注文日付</th>
                                    <th>行</th>
                                    <th>SKU</th>
                                    <th>個数</th>
                                    <th>注文番号</th>
                                </tr>
                            </thread>
                            @foreach($selfitem as $item)
                            <tr>
                                <td>{{ $item->id_in_box }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->line }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->aim_num }}</td>
                                <td>{{ $item->order_id }}</td>
                            </tr>
                            @endforeach
                        </table>

                    </div>

                </div>

            </div>
        </div>



    </div>

    @endsection
