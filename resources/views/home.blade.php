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
                                <li><a href="{{action('Admin\OrdersheetsController@index')}}"> 業務DB管理 </a></li>
                                <li><a href="{{action('Admin\ZonecodesController@index')}}"> 地代コードDB管理 </a></li>
                                <li><a href="{{action('Admin\SkutransfersController@index')}}"> SKU互換管理 </a></li>
                            </ul>
                        </div>
                        <div><font size="5">-------------------------------------</font></div>
                        <div><font size="5">これより下は作業者用ページです。</font></div>
                        <div><font size="5">-------------------------------------</font></div>
                        @endcan

                        @can('user-higher')
                        <li><a href="{{action('Work\WorkController@index')}}">業務ページへ</a></li>
                        <li><a href="{{action('Work\PrintController@index')}}">Box指定印刷</a></li>
                        <li><a href="{{action('Work\PrintController@single_index')}}">単品処理</a></li>
                        <li><a href="{{action('Work\ItemSearchController@index')}}">情報検索</a></li>
                        @endcan
                    </ul>
                </nav>


            </div>

            <div class="card">
                <div class="card-header">アップデート情報</div>
                <script type="text/javascript">
                function new_info(y,m,d,mes){

                    keep_day = 3;// この日数表示される
                    old_day = new Date(y+"/"+m+"/" +d);
                    new_day = new Date();
                    day = (new_day-old_day)/(1000*24*3600);
                    info ="&nbsp &nbsp";
                    if(day <= keep_day){
                        //info = info+ "NEW! &nbsp &nbsp ";
                        info = '&nbsp <img src="pic/material/new_icon.gif">';
                    }

                    info = "<td nowrap> &nbsp &nbsp " + y + "-" + m + "-" + d + info + " </td> <td>"  + mes + "</td>";
                    document.write(info);
                }
                </script>

                <div style="background: #ffffff; width:auto; border: 1px solid #f5f5f5; height:300px; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px; overflow: scroll;">
                    <table class = "table table-striped table-bordered table-hover">
                        <thead>
                            <tr><script>new_info(2018,10,23,"(1)インボイスの長住所を改行するように改善。<br> (2-1) 行番号で商品検索時、同じ注文番号の詳細も表示するように改善; <br>(2-2)商品検索時、多数ヒットする際のページネーションの表示バグを修正。")</script></tr>
                            <tr><script>new_info(2018,10,20,"商品検索ページに処理済みマークを追加")</script></tr>
                            <tr><script>new_info(2018,10,19,"グリーンラベルの商品名に個数を表示するように")</script></tr>
                            <tr> <script>new_info(2018,10,18,"印刷書類にボックス名追加")</script></tr>
                            <tr> <script>new_info(2018,10,18,"アップデート情報欄追加")</script></tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
