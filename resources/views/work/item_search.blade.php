@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="7">商品検索</font></div>
		<div class="panel-body">

		    {{--エラーの表示--}}
		    @if($errors->any())
		        <div class="alert alert-danger">
			<ul>
			    @foreach ($errors->all() as $error)
			        <li>{{ $error }}</li>
		            @endforeach
			</ul>
			</div>
		    @endif


		    <div class="alert alert-info">検索条件：</div>
		    <div>
		    <form action="{{action('Work\ItemSearchController@index')}}" method="GET">
		        <table class="table table-striped">
		        <tr>
			    <th width="15%">年</th>
			    <th width="15%">月</th>
			    <th width="15%">ボックス</th>
			    <th width="15%">SKU</th>
			    <th width="15%">行番号</th>
			    <th width="15%">注文番号</th>
			</tr>
		        <tr>
			　　<th><input type="text" name="year" placeholder="年" value={{$year}} ></th>
			    <th><input type="text" name="month" placeholder="月" value={{$month}} ></th>
			    <th><input type="text" name="box" placeholder="ボックス" value={{$box}} ></th>
			    <th><input type="text" name="sku" placeholder="SKU" value={{$sku}} ></th>
			    <th><input type="text" name="line" placeholder="行番号" value={{$line}} ></th>
			    <th><input type="text" name="orderid" placeholder="注文番号" value={{$orderid}} ></th>
			</tr>
			</table>
			<p><div class="button"><button type="submit">この条件で検索</button></div></p>
		    </form>
		    </div>
		    </br>

		    <div class="alert alert-success">検索結果：</div>
		    <div>
		        <table class="table table-striped table-bordered table-hover">	
			{{$ordersheets->links()}}<!--ページバーを表示する。-->

			<thead>
			    <tr>
			        <th width="15%">日付</th>
				<th width="15%">行</th>
				<th width="15%">box</th>
				<th width="15%">sku / 個数</th>
			    </tr>
			@foreach($ordersheets as $item)
			    @if($item->plural_marker!=NULL)
			    <tr bgcolor="pink">
			    @else
			    <tr>
			    @endif
			        <td>{{ $item->date }}</td>
			        <td>{{ $item->line }}</td>
			        <td>{{ $item->box }}</td>
			        <td>{{ $item->sku }} / {{$item->aim_num}}</td>
			    </tr>
			@endforeach
			</thead>
			</table>
		    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
