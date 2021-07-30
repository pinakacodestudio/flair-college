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
    <link href="{!! asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/jquery-switchbutton/jquery.switchButton.css') !!}" rel="stylesheet">
    {{--<link href="{!! asset('assets/lib/rickshaw/rickshaw.min.css') !!}" rel="stylesheet">--}}
    <!--<link href="admin/assets/lib/chartist/chartist.css') !!}" rel="stylesheet">-->

    <!-- sweetalert2 CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lib/sweetalert2/dist/sweetalert2.min.css') }}">

    <!-- Custom CSS -->
@yield('stylesheet')
<!-- Custom CSS END -->

    <!-- Bracket CSS -->
    <link href="{!! asset('assets/css/bracket.css?v='.config('app.css_version')) !!}" rel="stylesheet">

    <script>
        function getUrl(url) {
            return '{!! url('/') !!}' + ((url.substr(0, 1) === '/') ? url : '/' + url);
        }
    </script>

    <!-- Favicon -->
    <link rel="icon" href="{!! url('favicon.png') !!}" type="image/x-icon"/>
</head>
<body class="collapsed-menu">

<!-- ########## START: LEFT PANEL ########## -->
@include('includes/sidebar')
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
@include('includes/header')
<!-- ########## END: HEAD PANEL ########## -->

{{--<!-- ########## START: RIGHT PANEL ########## -->
@include('includes/right-sidebar')
<!-- ########## END: RIGHT PANEL ########## --->--}}

<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    @yield('content')

    @include('includes/footer')
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script src="{!! asset('assets/lib/jquery/jquery.js') !!}"></script>
<script src="{!! asset('assets/lib/popper.js/popper.js') !!}"></script>
<script src="{!! asset('assets/lib/bootstrap/bootstrap.js') !!}"></script>
<script src="{!! asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') !!}"></script>
<script src="{!! asset('assets/lib/moment/moment.js') !!}"></script>
<script src="{!! asset('assets/lib/jquery-ui/jquery-ui.js') !!}"></script>
<script src="{!! asset('assets/lib/jquery-switchbutton/jquery.switchButton.js') !!}"></script>
{{--<script src="{!! asset('assets/lib/peity/jquery.peity.js') !!}"></script>--}}
{{--<script src="{!! asset('assets/lib/chartist/chartist.js') !!}"></script>--}}
{{--<script src="{!! asset('assets/lib/jquery.sparkline.bower/jquery.sparkline.min.js') !!}"></script>--}}
{{--<script src="{!! asset('assets/lib/d3/d3.js') !!}"></script>--}}
{{--<script src="{!! asset('assets/lib/rickshaw/rickshaw.min.js') !!}"></script>--}}

<!-- sweetalert2 Javascript -->
<script rel="stylesheet" src="{{ asset('assets/lib/sweetalert2/dist/sweetalert2.js') }}"></script>

<script src="{!! asset('assets/js/bracket.js') !!}"></script>
<script src="{!! asset('assets/js/ResizeSensor.js') !!}"></script>

<!-- common Javascript -->
<script src="{!! asset('assets/js/common.js?v='.config('app.js_version')) !!}"></script>

<!-- Custom JS -->
@yield('javascript')
<!-- Custom JS END -->

</body>
</html>
