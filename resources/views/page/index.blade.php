@extends('layouts.app')

@section('page')
    <h2>Cửa hàng</h2>
@endsection
@section('content')
    <div class="row">
        @foreach($data['source'] as $source)
            <div class="col-lg-3 col-sm-4 col-xs-12">
                <div class="ibox float-e-margins shadow">
                    <a href="https://www.facebook.com/{{substr($source['_id'], 2, strlen($source['_id']))}}">
                        <div class="ibox-content text-center" style="height: 128px; padding: 8px 4px;">
                            <div class="">
                                <img alt="image" class="img-circle" src="{{$source['_source']['picture']}}">
                            </div>
                            <a href="https://www.facebook.com/{{substr($source['_id'], 2, strlen($source['_id']))}}"><strong> {{$source['_source']['name']}}</strong><br></a>
                            <small class="text-muted">
                                <div>
                                    {{$source['_source']['category']}} -
                                    <strong>{{$source['_source']['likes']}}</strong> lượt thích
                                </div>
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection