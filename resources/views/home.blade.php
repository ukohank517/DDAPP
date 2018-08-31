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
		    <nav>
		        <ul>
			  @can('system-only')
			    <li><a href="">システムのみ</a></li>
			  @elsecan('admin-higher')
			    <li><a href="">管理者ページへ</a></li>
			  @elsecan('user-higher')
			    <li><a href="">誰でも</a></li>
			  @endcan
			</ul>
		    </nav>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
