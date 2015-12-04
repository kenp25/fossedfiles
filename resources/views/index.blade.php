@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h4 class="breadcrumb">Login</h4>
            <form action="" method="post">
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @elseif(Session::has('message'))
                    <div class="alert alert-warning">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <input value="{{ csrf_token() }}" name="_token" type="hidden"/>
                <div class="form-group">
                    {{--<label for="username">Username</label>--}}
                    <input class="form-control" type="text" placeholder="Username" name="username"/>
                </div>
                <div class="form-group">
                    {{--<label for="password">Password</label>--}}
                    <input class="form-control" type="password" placeholder="Password" name="password"/>
                </div>
{{--                <div class="form-group">
                    <input type="checkbox" name="remember"> Remember Me
                </div>--}}
                <button class="btn btn-success" type="submit">Login</button>

            </form>
        </div>
        <div class="col-md-4"></div>

    </div>
@endsection
