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
			    <li><a href="">システム管理ページへ</a></li>
			  @elsecan('admin-higher')
			    <div onclick="obj=document.getElementById('adminmenu').style; obj.display=(obj.display=='none')?'block':'none';">
                                <a style="cursor:pointer;">管理者ツール</a>
			    </div>

			    <div id="adminmenu" sytle="display:none;clear:both;">
                                <ul>
				    <li><a href=""> データベース状況確認 </a></li>
				    <li><a href=""> データベースImport </a></li>
				    <li><a href=""> データベースExport </a></li>
				</ul>
			    </div>
			  @endcan
			    
			  @can('user-higher')
			    <li><a href="/app/public/work">業務ページへ</a></li>
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
