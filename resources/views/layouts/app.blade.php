<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMK</title>

    {{--icon--}}
    <link rel="shortcut icon" href="{{ asset('UET.png') }}" >

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <link href="{{asset('css/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet">


    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    {{--<script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>--}}


    <style>
        .shadow {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
        }
        .menu-level{
            position: absolute;
            top: 0;
            left: 100%;
            min-width: 100%;
            display:none;
            background-color: #2f4050;
        }
        #side-menu li:hover .menu-level-1 {
            display:block;
        }
        .menu-level-1 li:hover .menu-level-2 {
            display:block;
        }
        .menu-level-2 li:hover .menu-level-3 {
            display:block;
        }
        .menu-level-3 li:hover .menu-level-4 {
            display:block;
        }
        .menu-level-4 li:hover .menu-level-5 {
            display:block;
        }
    </style>
</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header" style="text-align: center;">
                    <div class="dropdown profile-element">
                        <span>
                            @if (Auth::user()->role_id==2)
                                <img width="48px" height="48px" class="img-circle" src="https://graph.facebook.com/v2.5/me/picture?access_token={{Auth::user()->access_token}}">
                            @endif
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        {{Auth::user()->name}}
                                    </strong>
                                </span><span class="text-muted text-xs block">
                                    @if (Auth::user()->role_id==2)
                                        Facebook
                                    @else
                                        Admin
                                    @endif <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#"><i class="fa fa-btn fa-cog"></i> Quản lý</a></li>
                            <li><a href="#"><i class="fa fa-btn fa-user"></i> Cá nhân</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <label>SMK</label>
                    </div>
                </li>
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i> <span class="nav-label">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/post')}}">
                        <i class="fa fa-shopping-bag"></i> <span class="nav-label">Sản phẩm</span>
                    </a>
                    <ul class="nav sidebar-collapse menu-level menu-level-1">
                        <li>
                            <a href="#">Thời trang</a>
                            <ul class="nav sidebar-collapse menu-level menu-level-2">
                                <li>
                                    <a href="#">
                                        Thời trang nam
                                    </a>
                                    <ul class="nav sidebar-collapse menu-level menu-level-3">

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Thời trang nữ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Đồ điện tử</a>
                            <ul class="nav sidebar-collapse menu-level menu-level-2">
                                <li>
                                    <a href="#">Điện thoại</a>
                                </li>
                                <li>
                                    <a href="#">Laptop</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/page')}}">
                        <i class="fa fa-building"></i> <span class="nav-label">Cửa hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/about')}}">
                        <i class="fa fa-info"></i> <span class="nav-label">Về chúng tôi</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashboard_2">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header col-md-12">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" style="width: 90%;" method="get" action="/search">
                        <div class="form-group">
                            <input type="text" placeholder="Tìm kiếm sản phẩm hoặc cửa hàng ..." class="form-control" name="q" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                </ul>
            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                @yield('page')
                <ol class="breadcrumb">
                    @yield('link')
                </ol>
            </div>
        </div>
        <div class="row animated fadeInRight">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="footer" >
            <div class="pull-right">
                UET - VNU
            </div>
            <div>
                <strong>SMK</strong> Data Science & Knowledge Technology Lab &copy; 2016
            </div>
        </div>
    </div>
</div>
</body>
</html>
