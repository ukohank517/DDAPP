@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Print Page</div>

                <div class="card-body">
		    @if ($errors->any())
		        <div class="alert alert-danger">
			    <ul>
			        @foreach($errors->all() as $error)
				<li> {{ $error }} </li>
				@endforeach
			    </ul>
			</div>
		    @endif
		    <div>
		        <form action="{{action('Work\PrintController@print')}}" method="get">
			    <p><input type="text" name="boxname" placeholder="ボックス名"></p>
			    <p><input type="checkbox" name="page[]" value="greenlabel"> グリーンラベル</p>
			    <p><input type="checkbox" name="page[]" value="invoice"> インボイス</p>
			    <button type="submit">作成</button>
			</form>
		    </div>
		    <div>
		        <div class="alert alert-info">結果ゾーン</div>
		        @if (Session::has('greenlabel_flag'))
		            <p><a href="../sample.pdf" target="_blank"> [{{$boxname}}]greenlabel </a></p>
		        @endif
		        @if (Session::has('invoice_flag'))
		            <p><a href=""> [{{$boxname}}]invoice </a></p>
		        @endif
		    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
