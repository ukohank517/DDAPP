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
			    <li><div onclick="obj=document.getElementById('adminmenu').style; obj.display=(obj.display=='none')?'block':'none';">
                                <a style="cursor:pointer;">管理者ツール</a>
			    </div></li>

			    <div id="adminmenu" sytle="display:none;clear:both;">
                                <ul>
				    <li><a href=""> 業務DB管理 </a></li>
				    <li><a href="../public/admin/zonecodes"> 地代コードDB管理 </a></li>
				    <li><a href="../public/admin/skutransfers"> SKU互換管理 </a></li>
				</ul>
			    </div>
			    <div><font size="5">-------------------------------------</font></div>
			    <div><font size="5">これより下は作業者用ページです。</font></div>
			    <div><font size="5">-------------------------------------</font></div>
			  @endcan
			    
			  @can('user-higher')
			    <li><a href="../public/work">業務ページへ</a></li>
			    <li><a href="">Box指定印刷</a></li>
			    <li><a href="">単品処理</a></li>
			    <li><a href="">単品処理</a></li>
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
