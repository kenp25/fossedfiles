
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

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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

<div class="container-fluid">
    <div class="row">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload document</h4>
                    </div>

                    <div class="modal-body">
                        <form action="/upload" method="get" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="type">System</label>
                                <select class="form-control" name="system">
                                    @foreach($systems as $system)
                                        <option value="{{ $system->id }}">{{ $system->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="doc_type">Document Type</label>
                                <select class="form-control" name="doc_type">
                                    @foreach($document_list as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="" name="user" value="{{ Auth::getUser()->id }}"/>
                            <div class="form-group">
                                <input type="file" class="" name="upload"/>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="description" placeholder="Enter description"></textarea>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 {{--col-sm-offset-3 col-md-10 col-md-offset-2--}}">
            <div>
                <h2 class="sub-header page-header">
                 <a class="btn btn-success" href="#" data-toggle="modal" data-target="#myModal">Upload Document</a></h2>

            </div>
            @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hovered table-striped">
                    <thead>
                    <tr>
                        <th><a href="?sort=title&order={{ $sort != 'title' ? 'asc' : ( $order == 'asc' ? 'desc': 'asc')  }}">Title</a></th>
                        <th><a href="?sort=description&order=asc">Description</a></th>
                        <th>
                            <li class="dropdown" style="list-style: none">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">System<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li><a href="/dashboard">All</a></li>
                                    @foreach($systems as $system)
                                        <li><a href="/dashboard?system_id={{ $system->id }}" >{{ $system->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </th>
                        <th>
                            <li class="dropdown" style="list-style: none">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">System<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li><a href="/dashboard">All</a></li>
                                    @foreach($document_list as $list)
                                        <li><a href="/dashboard?system_id={{ $list->id }}" >{{ $list->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </th>
                        <th>
                            <li class="dropdown" style="list-style: none">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Uploaded by<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li><a href="/dashboard">All</a></li>
                                    @foreach($users as $user)
                                        <li><a href="/dashboard?user={{ $user->id }}" >{{ $user->fullName() }}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                        </th>
                        <th><a href="?sort=created_at&order=asc">Date Uploaded</a></th>
                        {{--<td><a href="#"><span class="fui-eye"></span></a></td>--}}
                        <td><a href="#"><span class="fui-triangle-down"></span></a></td>
                        <td><a href="#">Delete</a></td>
                    </tr>
                    </thead>

                    <tbody>
                    @if($system_document->count())
                        @foreach($system_document as $document)
                            <tr>
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->description }}</td>
                                <td>{{--{{ $document->type->name }}--}}</td>
                                <td></td>
                                <td>{{ $document->user->fullName() }}</td>
                                <td>{{ $document->created_at->diffForHumans()}}</td>
                                <td><a href="{{ $document->path }}" download="">Download</a></td>
                                <td><a href="/delete/{{ $document->id }}"><span class="fui-trash"></span></a></td>
                            </tr>
                        @endforeach

                    @else
                        <td colspan="8"><div style="text-align: center; padding: 3em; font-size: 3em; color: #ccc;">
                                <div><span></span></div>Nothing Found</div>
                        </td>
                    @endif
                    </tbody>

                </table>
            </div>

             {{--<div>{!! $documents->render() !!}</div>--}}
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

