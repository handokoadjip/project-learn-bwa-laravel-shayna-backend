<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ShaynaAdmin - @yield('title')</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('append-style')
</head>

<body>
    <!-- Left Panel -->
    @include('includes.admin.sidebar')
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        @if (session()->has('alert'))
        @include('sweetalert::alert')
        @php
        Session::forget('alert');
        @endphp
        @endif

        <!-- Header-->
        @include('includes.admin.header')
        <!-- /#header -->

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /#content -->
        <div class="clearfix"></div>
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    @stack('prepend-scripts')
    @include('includes.admin.script')
    @stack('append-scripts')
    <!-- /#Scripts -->


</body>

</html>