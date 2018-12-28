@extends('order_receive.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="7">在庫管理</font></div>

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('success_msg'))
                <div class="alert alert-success">
                    {{Session::get('success_msg')}}
                </div>
                @endif

                <div>
                    <table class="table table-striped table-bordered table-hover">
                        {{$stockitems->links()}}
                        <thread>
                            <tr>
                                <th>parent_sku</th>
                                <th>stock_num</th>
                                <th>price</th>
                                <th>place</th>
                                <th>memo</th>
                                <th>編集</th>
                            </tr>
                        </thread>

                        @foreach($stockitems as $item)
                        <tr>
                            @if($edit_id != $item->id)
                            <td>{{$item->parent_sku}}</td>
                            <td>{{$item->stock_num}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->place}}</td>
                            <td>{{$item->memo}}</td>
                            <td><form method="PUT" action="{{route('order_receive::stockitems.select')}}">
                                <button name="edit_id" value="{{$item->id}}" type="submit" class="btn btn-primary btn-join">編集</button>
                            </form></td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                    @if($edit_id!=-1)
                    <div class="alert alert-danger">
                        <p>編集部分</p>
                        <form method="PUT" action="{{route('order_receive::stockitems.edit')}}">
                            {{$edit_data->parent_sku}}
                            <p>在庫数量: <input type="text" name="stock_num" value="{{$edit_data->stock_num}}" ></p>
                            <p>仕入値段: <input type="text" name="price" value="{{$edit_data->price}}"></p>
                            <p>置き場所: <input type="text" name="place" value="{{$edit_data->place}}"></p>
                            <p>メモ項目: <input type="text" name="memo" value="{{$edit_data->memo}}"></p>

                            <button name="edit_id" value="{{$edit_id}}" type="submit" class="btn btn-danger btn-join">確定</button>
                        </form>
                        <a href="{{route('order_receive::stockitems.index')}}"><button>キャンセル</button></a>
                    </div>
                    @endif

            </div>
        </div>
    </div>
    @endsection
