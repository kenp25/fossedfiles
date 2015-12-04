
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
{{--        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Users</a></li>
                <li><a href="/admin/systems">Systems</a></li>
                <li><a href="/admin/types">Document types</a></li>
                <li><a href="/admin/docs">System documents</a></li>
                <li><a href="/admin/settings">Settings</a></li>
            </ul>
        </div>--}}
    </div>
    <div class="{{--col-sm-offset-3--}} col-md-12 {{--col-md-offset-2--}}">
    <h4 class="sub-header page-header">Edit Users</h4>
    <div class="row">
        <div class="col-lg-6">
                    @if ($errors->has())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    @elseif(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        <a href="/">Login</a>
                    </div>

                    @endif
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="firstname">First Name <span style="color: red">*</span></label>
                            <input type="text" name="firstname" class="form-control" value="{{ $users->firstname }}"/>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name <span style="color: red">*</span></label>
                            <input type="text" name="lastname" class="form-control" value="{{ $users->lastname }}"/>
                        </div>

                        <div class="form-group">
                            <label for="user_type">User type <span style="color: red">*</span></label>
                            <input type="text" name="user_type" class="form-control" value="{{ $users->type }}"/>
                        </div>

                        <div class="form-group">
                            <label for="username">Username <span style="color: red">*</span></label>
                            <input type="text" name="username" class="form-control" value="{{ $users->username }}"/>
                        </div>



                        <button class="btn btn-success" type="submit">Update</button>
                        <a class="btn btn-danger" href="/admin">Cancel</a>


                    </form>
        </div>
        <div class="col-lg-6"></div>
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