@extends('stock_work.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">提案ページ</div>
                <div class="alert alert-success">SKU: 【{{ $former_sku }}】</div>
                <div class="card-body">

<p>{{$ordersheets}}</p>


                    <form atcion="{{route('stock_work::work.recommend')}}">
                        <p><input type="hidden" name="zero_ignore" value={{$zero_ignore}}></p>
                        <p><input type="hidden" name="former_sku" value={{$former_sku}}></p>
                        <p><input type="submit" value="次へ"></p>
                    </form>
                </div>
            </div>
        </div>



    </div>

    @endsection
