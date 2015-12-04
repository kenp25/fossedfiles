
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

    <!-- Custom styles for this template -->
    <link href="{{asset('/assets/css/dashboard.css')}}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
</head>

<body>

<div class="navbar navbar-inverse nav-bar-custom" role="navigation">
    <div class="container">
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
                            @if(Auth::getUser()->type() == 'Admin')
                                <li><a href="/welcome">Welcome</a></li>
                                <li><a href="/admin">Users</a></li>
                                <li><a href="/admin/systems">Systems</a></li>
                                <li><a href="/admin/types">Document types</a></li>
                                <li><a href="/admin/docs">System documents</a></li>
                            @endif
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

<div class="container">
    <div class="row">

        <div class="col-lg-6">
            @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>

            @elseif(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @elseif(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="New Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                </div>

                <button class="btn btn-success" type="submit">Submit</button>
            </form>

        </div>
        <div class="col-lg-6"></div>
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