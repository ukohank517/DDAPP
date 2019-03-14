@extends('stock_work.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">提案ページ</div>
                    @if(strcmp($former_sku, "FINISH")!=0)
                    <div class="alert alert-success">
                    <center>SKU: 【{{ $former_sku }}】</center>
                        @if(count($skuinfo) == 0)
                        <center>??????????????????????情報なし??????????????????????</center>
                        @endif
                        @foreach($skuinfo as $item)
                        <p>【{{$item->parent_sku}}】 × {{$item->parent_num}} ---------- {{$stocknums[$item->parent_sku]}}</p>
                        @endforeach
                    </div>
                    @endif


                <div class="card-body">
                    <div>
                        <form action={{route('stock_work::work.deal_and_recommend')}} method="get">
                            <div>
                                @foreach($ordersheets as $items)
                                <table class="table table-striped table-bordered table-hover">
                                    <thread>
                                        <tr>
                                            <th>処理</th>
                                            <th>状態</th>
                                            <th>注文日付</th>
                                            <th>行</th>
                                            <th>SKU</th>
                                            <th>個数</th>
                                            <th>注文番号</th>
                                        </tr>
                                    </thread>
                                    @foreach($items as $item)
                                    <tr>

                                        @if($item->id == $items[0]->id)
                                        <?php $hoge= count($items); ?>
                                        <td align="center" rowspan="{{$hoge}}">
                                            <input style="transform:scale(2); " type="checkbox" name="deal_ids[]" value="{{ $item->id}}">
                                        </td>
                                        @endif
                                        @if(strcmp($item->stock_stat, "在庫") == 0)
                                        <td>在庫</td>
                                        @elseif(($item->aim_num <= $item->stock_num))
                                        <td>4F処理済</td>
                                        @else
                                        <td>4F未処理</dt>
                                        @endif
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->line }}</td>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ $item->aim_num }}</td>
                                        <td>{{ $item->order_id }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endforeach
                            </div>
                            @if(strcmp($former_sku , "FINISH") == 0)
                            <p>一通り終了しました。お疲れ様です。</p>
                            <a class="btn btn-primary btn-join"href="{{route('stock_work::work')}}">戻る</a>
                            @else
                            <p><input type="hidden" name="zero_ignore" value={{$zero_ignore}}></p>
                            <p><input type="hidden" name="former_sku" value={{$former_sku}}></p>
                            <input type="submit" class="btn btn-primary btn-join" value="処理して次へ">
                            @endif
                        </form>
                    </div>
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
