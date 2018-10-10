@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">searchresult</div>

		<div>{{$info_message}} [ {{$sku_token}} ] </div>
		<div>待ちボックス: [{{$wait_box}}]</div>
		<table class="table table-striped table-bordered table-hover">
		    <thread>
		        <tr>
		            <th width="15%">注文日付</th>
			    <th width="10%">Line</th>
			    <th width="35%">注文番号</th>
			    <th width="10%">発送</th>
			    <th width="10%">aim/stock</th>
			    <th width="15%">処理</th>
			</tr>
		    </thread>
		    @foreach($hit_items as $item)
		        <tr>

			    <td>{{ $item->date }}</td>
			    <td>{{ $item->line }}</td>
			    <td>{{ $item->order_id }}</td>
			    <td>{{ $item->sendway }}</td>
			    <td>{{ $item->stock_num }}/{{ $item->aim_num }}</td>
			    @if($sku_token == $item->sku && !(Session::has('secondtime_flag')))
			    <td>
			       <form method="PUT" action="{{action('Work\SearchResultController@deal_item')}}" >
				    <div class="">
			                +1 <button name="id" value="{{$item->id}}"  type="submit" class="btn btn-primary btn-join">確定</button> 
			            </div>
				</form>
			    </td>
			    @endif

			</tr>
	            @endforeach
		</table>
		
		
	        @if(Session::has('fin_flag'))
		    <div class="alert alert-success"> 揃った 
		        <form method="PUT" action="{{action('Work\SearchResultController@put_into_box')}}" >
		            <div class="">
			        <button name="id" value="{{$item->id}}"  type="submit" class="btn btn-primary btn-join">ボックスへ入れる</button> 
			    </div>
		        </form>
		    </div>

		@endif
		

		<form>
		  <input type="button" value="作業ページへ戻る" onClick="kakuninn()">
		</form>

		<script>
		function kakuninn(btnNo){
		    @if(Session::has('fin_flag'))
		        ret = confirm("処理したが、ボックスに入れないですか？");
		        if (ret == true){location.href = "/app/public/work" ;}
		    @else
		        location.href = "/app/public/work";
		    @endif
		}
		</script>
            </div>


	    @if(Session::has('cancel_flag'))
	    <script>alert("キャンセル商品");</script>	
	    @endif
	    @if(Session::has('plural_flag'))
	    <script>alert("複数商品");</script>
	    @endif
	    @if(Session::has('sendway_flag'))
	    <script>alert("発送方法が特殊な商品");</script>
	    @endif
	    @if(Session::has('overtime_flag'))
	    <script>alert("{{$overtime_value}}日よりも前の注文商品にヒットした。");</script>
	    @endif
	    @if(Session::has('stockstat_flag'))
	    <script>alert("在庫商品です！処理しないなら下の戻るボタンを押してください。");</script>
	    @endif


	    @if(Session::has('overlapping_flag'))
	        <script>
	            ret = confirm("処理エラー、作業ページへ遷移。\r\n商品を再検索してください。")
		    location.href = "../work";
		</script>
            @endif


        </div>
    </div>
</div>

@endsection
