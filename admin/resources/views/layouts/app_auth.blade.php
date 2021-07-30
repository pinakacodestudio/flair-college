<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
{{--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- vendor css -->
    <link href="{!! asset('assets/lib/font-awesome/css/font-awesome.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/Ionicons/css/ionicons.css') !!}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link href="{!! asset('assets/css/bracket.css') !!}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
</head>
<body>

@yield('content')

<script src="{!! asset('assets/lib/jquery/jquery.js') !!}"></script>
<script src="{!! asset('assets/lib/popper.js/popper.js') !!}"></script>
<script src="{!! asset('assets/lib/bootstrap/bootstrap.js') !!}"></script>
</body>
</html>
