@extends('layouts.app')
@section('page')
    <h2>Kết quả tìm kiếm cho từ khóa <strong>"{{$data['query']}}"</strong></h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox float-e-margins shadow">
                <div class="ibox-title">
                    <h5>Bài đăng</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light">... kết quả</span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        @foreach($data['post'] as $post)
                        <div class="feed-element">
                            <div class="pull-left">
                                <img alt="image" class="img-circle" src="img/a5.jpg">
                            </div>
                            {{--<small class="pull-right">2h ago</small>--}}
                            <a href="https://www.facebook.com/{{$post['_source']['fromId']}}">
                                <strong>{{$post['_source']['fromName']}}</strong><br>
                            </a>

                            <small class="text-muted"><div>{{$post['_source']['date']}}</div></small>

                            <div class="wrapper wrapper-content">
                                <div class="col-lg-4">
                                    @if($post['_source']['urlImage']!=null)
                                        <img src="{{$post['_source']['urlImage']}}" style="width: 100%;" class="shadow">
                                    @else
                                    @endif

                                </div>
                                <div class="col-lg-8">
                                    {{--<div class="well">--}}
                                        {{$post['_source']['content']}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins shadow">
                <div class="ibox-title">
                    <h5>Trang</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light">... kết quả</span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-element">
                        <div class="feed-activity-list">
                            @foreach($data['source'] as $source)
                                <div class="feed-element">
                                    <div class="pull-left">
                                        <img alt="image" class="img-circle" src="{{$source['_source']['picture']}}">
                                    </div>
                                    <a href="https://www.facebook.com/{{substr($source['_id'], 2, strlen($source['_id']))}}"><strong> {{$source['_source']['name']}}</strong><br></a>

                                    <small class="text-muted">
                                        <div>
                                            {{$source['_source']['category']}} -
                                            <strong>{{$source['_source']['likes']}}</strong> lượt thích
                                        </div>
                                    </small>
                                    {{--<div class="well">--}}
                                        {{--abc--}}
                                    {{--</div>--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block m-t">Xem tất cả</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var data = JSON.parse(<?php echo json_encode(json_encode($data))?>);
//    document.write(JSON.stringify(data['post'][0], null, '\t'));
</script>