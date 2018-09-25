@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">workspace</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

		    <form action="work/greet" name="フォームの名前" method="GET">
		        <p><input type="text" size="50" placeholder="SKU"></p>
			<p><input type="submit" value="検索"></p>
		    </form>
		    <div>
		        <div class = "alert  alert-info">ボックス詳細[ボックス名:{{$box_name}}]</div>

			<table class="table table-striped table-bordered table-hover">
			    <thead>
			        <tr>
				    <th width="10%">No.</th>
				    <th width="10%">Line</th>
				    <th width="15%">sku</th>
				    <th width="15%">注文番号</th>
				    <th width="15%">発送方法</th>
				</tr>
			    </thead>
			    @foreach($dealing_items as $item)
			        <tr>
				    <td>{{ $item->id_in_box }}</td>
				    <td>{{ $item->line }}</td>
				    <td>{{ $item->sku }}</td>
				    <td>{{ $item->order_id }}</td>
				    <td>{{ $item->sendway }}</td>
				</tr>
			    @endforeach
			</table>
		    </div>

		    @if (Session::has('flash_message'))
		        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
		    @endif
		    
		    <form action="work/delete_last_line" name="最終行削除" method="GET">
			<p><input type="submit" value="最終行削除"></p>
		    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
