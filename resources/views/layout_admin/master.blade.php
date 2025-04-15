<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>
        CTY HYTERTECH
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <link rel="shortcut icon" href="#">

    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>

<body>

<div class="wrapper">
    @include('layout_admin.header')
    @include('layout_admin.sidebar')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">
                                #
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row">
{{--                    @if (session()->has('success'))--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="alert alert-success">--}}
{{--                                {{ session()->get('success') }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('layout_admin.footer')
    </div>
    
</div>
@include('layout_admin.rightbar')

<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/hyper-config.js') }}"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
@stack('js')
<script>
    $(document).ready(function () {
        $('#light-dark-mode').click(function () {
            $('.uil-sun, .uil-moon').toggleClass('d-none');
        });

        $('#screen').click(function () {
            $('.uil-focus, .uil-compress').toggleClass('d-none');
        });
    });
</script>
</body>
</html>
