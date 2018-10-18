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
                            <!--
                            @can('role')
                            @elsecan('role')
                            @endcan
                        -->

                        @can('unknown-people')
                        <li><a href="">管理者よりアクセス権限を申請してください。</a></li>
                        @endcan

                        @can('admin-higher')
                        <li><div onclick="obj=document.getElementById('adminmenu').style; obj.display=(obj.display=='none')?'block':'none';">
                            <a style="cursor:pointer;">管理者ツール</a>
                        </div></li>

                        <div id="adminmenu" sytle="display:none;clear:both;">
                            <ul>
                                <li><a href="../public/admin/ordersheets"> 業務DB管理 </a></li>
                                <li><a href="../public/admin/zonecodes"> 地代コードDB管理 </a></li>
                                <li><a href="../public/admin/skutransfers"> SKU互換管理 </a></li>
                            </ul>
                        </div>
                        <div><font size="5">-------------------------------------</font></div>
                        <div><font size="5">これより下は作業者用ページです。</font></div>
                        <div><font size="5">-------------------------------------</font></div>
                        @endcan

                        @can('user-higher')
                        <li><a href="work">業務ページへ</a></li>
                        <li><a href="print">Box指定印刷</a></li>
                        <li><a href="single_print">単品処理</a></li>
                        <li><a href="item_search">情報検索</a></li>
                        @endcan
                    </ul>
                </nav>


            </div>
            <div class="card">
                <div class="card-header">アップデート情報</div>
                <div>
                    2018-10-18-- コード内部インデント修正
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
