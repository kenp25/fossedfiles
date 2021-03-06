
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/assets/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/flat-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/fonts/awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/assets/css/dashboard.css')}}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top nav-bar-custom" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><span class="fui-document"></span>  DMS</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li><a href="{{ url('/') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fui-user"></span> {{ Auth::getUser()->fullName() }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/welcome">Welcome</a></li>
                            <li><a href="/admin">Users</a></li>
                            <li><a href="/admin/systems">Systems</a></li>
                            <li><a href="/admin/types">Document types</a></li>
                            <li><a href="/admin/docs">System documents</a></li>
                            <li><a href="/change_password">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
                                        <form class="navbar-form navbar-right" action="/searches">
                                            <div class="input-group">
                                                <input class=" pull-right search-custom" id="searchbox" name="q" type="text" placeholder="Search"/>
                                                {{--<div class="input-group-btn"><button class="btn btn-info search-btn-custom" type="submit"><span class="fui-search"></span></button></div>--}}
                                            </div>
                                        </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="/admin">Users</a></li>
                <li><a href="/admin/systems">Systems</a></li>
                <li><a href="/admin/types">Document types</a></li>
                <li><a href="/admin/docs">System documents</a></li>
                <li><a href="/admin/settings">Settings</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-offset-3 col-md-10 col-md-offset-2">

        <div class="col-lg-12 col-md-12 col-sm-12">
        <h4 class="sub-header page-header">Systems<a data-toggle="tooltip" data-placement="top" title="Add System" href="/admin/systems/add"><span class="fui-plus-circle pull-right"></span></a></h4>
{{--        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif--}}
            @foreach($systems as $system)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $system->name }}</div>
                        <div class="panel-body">
                        <div>{{ $system->description }}</div><hr>
                            <div class="row">
                            <div class="col-lg-6">
                            @foreach($document_list as $list)
                                <div class="col-xs-6 col-sm-6 col-lg-2 card" style="text-align: center"><a href="/document?system_id={{ $system->id }}&doc_id={{$list->id }}"><span
                                        @if($list->id == 1 )
                                            style="color: #43C6DB"
                                            class="fa fa-2x fa-server"
                                            data-toggle="tooltip" title="{{ $list->name }}"
                                        @elseif($list->id == 2)
                                            style="color: #C25283"
                                            class="fa fa-2x fa-area-chart"
                                            data-toggle="tooltip" title="{{ $list->name }}"
                                        @elseif($list->id == 3)
                                            style="color: #795548"
                                            class="fa fa-2x fa-book"
                                            data-toggle="tooltip" title="{{ $list->name }}"
                                        @elseif($list->id == 4)
                                            style="color: #727272"
                                            class="fa fa-2x fa-file-powerpoint-o"
                                            data-toggle="tooltip" title="{{ $list->name }}"
                                        @elseif($list->id == 5)
                                            style="color: #607D8B"
                                            class="fa fa-2x fa-archive"
                                            data-toggle="tooltip" title="{{ $list->name }}"
                                        @endif>
                                        </span>{{--{{ $list->name }}--}}</a></div>
                            @endforeach
                            </div>
                            <div class="col-lg-6"></div>

                            </div>
                        </div>
                    </div>
            @endforeach
        </div>

    </div>

    </div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/vendor/jquery-1.11.1.min.js') }}"></script>

<script src="{{asset('/assets/js/vendor/html5shiv.js')}}"></script>
<script src="{{asset('/assets/js/vendor/respond.min.js')}}"></script>
<script src="{{asset('/assets/js/flat-ui.min.js')}}"></script>
</body>
</html>