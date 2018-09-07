@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
		    <div onclick="obj=document.getElementById('open').style; obj.display=(obj.display=='none')?'block':'none';">
		        <a style="cursor:pointer;">▶クリックで展開</a>
		    </div>
		    <div id="open" sytle="display:none;clear:both;">
		        <nav>
			    <ul>
			        <li><a> list1</a></li>
			        <li><a> list1</a></li>
			    </ul>
			</nav>
		    </div>


                    welcome to working page!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
