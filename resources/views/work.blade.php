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
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
