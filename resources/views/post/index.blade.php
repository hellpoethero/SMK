@extends('layouts.app')

@section('page')
    <h2>Sản phẩm</h2>
@endsection
@section('content')
    <style>
        .square {
            float:left;
            position: relative;
            width: 100%;
            padding-bottom : 67%; /* = width for a 1:1 aspect ratio */
            background-position:center center;
            background-repeat:no-repeat;
            background-size:cover; /* you change this to "contain" if you don't want the images to be cropped */
        }
    </style>
    <div class="row">
        @foreach($data['post'] as $post)
            <div class="col-lg-3 col-sm-4 col-xs-12">
                <div class="ibox float-e-margins shadow">
                    <a href="https://www.facebook.com/{{$post['_source']['fromId']}}">
                        <div class="square" style="background-image: url('{{$post["_source"]["urlImage"]}}');"></div>
                        <div class="ibox-content text-center" style="min-height: 96px; padding: 4px;">
                            <strong>{{$post['_source']['fromName']}}</strong><br>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection