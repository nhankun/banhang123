<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>CellPhone - Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an manager pages for web.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="{{ asset('backs/admin/main.css') }}" rel="stylesheet">

    <script src="{{ asset('backs/admin/assets/jquery/dist/jquery.min.js') }}"></script>

    <link href="{{ asset('backs/admin/assets/fontawesome/css/all.css') }}" rel="stylesheet">

    <script src="{{ asset('backs/admin/assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script src="{{asset('jquery/dist/jquery.validate.js')}}" type="text/javascript"></script>

    <link rel="stylesheet" href="{{ asset('backs/admin/assets/sweetalert2/dist/sweetalert2.min.css') }}">
    @yield('css')
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    @include('backs.layouts.partials.header')

    @include('backs.layouts.partials.setting_theme_ui')
    <div class="app-main">

       @include('backs.layouts.partials.sidebar')

        <div class="app-main__outer">
            <div class="app-main__inner">

                @yield('main_content')

            </div>
            @include('backs.layouts.partials.footer')
        </div>
{{--        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
    </div>
</div>
<script type="text/javascript" src="{{ asset('backs/admin/assets/scripts/main.js') }}"></script>
@yield('script')
</body>
</html>
