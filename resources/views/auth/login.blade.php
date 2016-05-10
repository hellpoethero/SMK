<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMK</title>

    {{--icon--}}
    <link rel="shortcut icon" href="{{ asset('UET.png') }}" >

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body class="gray-bg" style="background-color: #2f4050;">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div class="">
        <h1 class="logo-name" style="font-size: 1000%;">SMK</h1>
        <h3>Chào mừng tới với SMK</h3>
        <p>Vui lòng đăng nhập</p>
        <form class="m-t"  role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Ghi nhớ
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary block full-width m-b">
                    <i class="fa fa-btn fa-sign-in"></i> Đăng nhập
                </button>
                <a class="btn btn-link" href="{{ url('/password/reset') }}"><small>Quên mật khẩu?</small></a>
            </div>
        </form>
        <a href="{{url('auth/facebook')}}">
            <button class="btn btn-facebook btn-success full-width"><i class="fa fa-facebook-official"></i> Đăng nhập bằng Facebook</button>
        </a>
    </div>
</div>
</body>
</html>
