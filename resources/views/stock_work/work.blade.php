@extends('stock_work.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">在庫品処理ページ</div>
                <div class="card-body">
                    <form action="{{route('stock_work::work.recommend')}}">
                        <p><input type ="checkbox" name="zero_ignore" value={{$zero_ignore}}>　0在庫無視</p>
                        <p><input type ="hidden" name="former_sku" value={{$former_sku}}></p>                        
                        <p><input type="submit" value="システムより提案"></p>
                    </form>
                </div>
            </div>
        </div>



    </div>

    @endsection
