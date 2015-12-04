<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/assets/css/flat-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/assets/css/flat-ui.min.css') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="container">
    @include('partials.header')
    @yield('content')
</div>

<script src="{{ asset('/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/vendor/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('/assets/js/flat-ui.min.js') }}"></script>
<script src="{{ asset('/assets/js/vendor/selectize.js') }}"></script>

</body>
</html>