
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
                <form class="navbar-form navbar-right" action="/searches">
                    <div class="input-group">
                        <input class=" pull-right search-custom" id="searchbox" name="q" type="text" placeholder="Search"/>
                        {{--<div class="input-group-btn"><button class="btn btn-info search-btn-custom" type="submit"><span class="fui-search"></span></button></div>--}}
                    </div>
                </form>
            </ul>
        </div>
    </div>
</div>

<div class="container">
<div class="row">
    <div class="col-lg-12"><a href="/welcome"><span data-toggle="tooltip" data-placement="top" title="Back" class="fui-arrow-left pull-left"></span></a><a data-toggle="tooltip" data-placement="top" title="Upload document" href="/upload"><span class="fui-plus-circle pull-right"></span></a></div>
    <div class="col-lg-12">

    @if($system_documents->count())

            <div class="panel panel-default">
                <div class="panel-heading">{{ $system->name }} |{{ $document_code->name }}</div>
                <div class="panel-body">
                @foreach($system_documents as $system_document)
                <div class="row">
                    <div class="col-lg-2">Title: {{ $system_document->name }}</div>
                    <div class="col-lg-4">Uploaded By: {{ $system_document->user->fullName()}}</div>
                    <div class="col-lg-4">Uploaded On: {{ $system_document->created_at}}</div>
                    <div class="col-lg-2"><a data-toggle="tooltip" data-placement="top" title="Download" download="" href="{{ $system_document->path }}"><span class="fa fa-download"></span></a></div>
                </div>
                <div>Description: <br><div style="border: solid 1px lightgrey; padding-left: 10px; border-radius: 3px; padding-bottom: 10px;padding-top: 10px">{{ $system_document->description }}</div></div>


                <hr>
                @endforeach
                </div>

            </div>

    @else
        <div class="panel panel-default">
            <div class="panel-heading">{{ $system->name }}</div>
            <div class="panel-body">

            <div>Nothing to show for {{ $document_code->name }}  under {{ $system->name }}</div>

            </div>
        </div>

    @endif
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

