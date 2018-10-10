@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Single Print</div>

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
		        <form action="{{action('Work\PrintController@single_print')}}" method="get">
			    <p><input type="text" name="month" placeholder="月"></p>
			    <p><input type="text" name="line" placeholder="行番号"></p>
			    <button type="submit">作成</button>
			</form>
		    </div>

		    <div>
		        <div class="alert alert-info">結果ゾーン</div>
			@if(Session::has('file_exist'))
			    <p><a href="../single_invoice.pdf" target="_blank">invoice</a></p>
			@endif
		    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
