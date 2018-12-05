@extends('order_receive.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><font size="7">発注書更新</font></div>
                <div>ファイル上限: about 1M</div>
                <div class="panel-body">
                    @if (Session::has('flash_message'))
                    <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @elseif (Session::has('e_flash_message'))
                    <div class="alert alert-danger">{{ Session::get('e_flash_message') }}</div>
                    @endif

                    {{-- エラーの表示 --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb10">
                        {!! Form::model($orderdocuments, [
                            'url' => route('order_receive::orderdocuments.upload'),
                            'method' => 'POST',
                            'files' => true
                            ]) !!}

                            <div>(ダテなう)発注書ID　<input name="doc_id" placeholder="適当でええで" required></div>
                            <div>(ダテだう)発注日：　<input type="date" name="order_date"  required></div>
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::file('csv_file', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-md-8">
                                    {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
                                    {{ link_to_route('order_receive::orderdocuments.download', 'ダウンロード', null, ['class' => 'btn btn-default']) }}
                                </div>
                            </div>


                            {!! Form::close() !!}
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </div>
    @endsection
