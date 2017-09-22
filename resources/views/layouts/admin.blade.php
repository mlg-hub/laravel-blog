<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/admin.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/common.css') }}">
    @yield('styles')
</head>
<body>
@include('includes.header-admin')

<div class="main">
    @yield('content')
</div>
    <script type="text/javascript">
        var baseUrl = '{{URL::to('/')}}';
    </script>
@yield('scripts')
</body>
</html>