<!DOCTYPE html>
<html lang="en" data-sidenav-size="fullscreen">

<head>
    <meta charset="utf-8" />
    <title>Cty HyterTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="#">
    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('css')
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">
        @include('layout.sidebar')
        @include('layout.header')
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>

                    </div>
                    <!-- end row -->
                </div>
                <!-- container -->
            </div>
            <!-- content -->
            @include('layout.footer')
        </div>

    </div>
    @include('layout.rightbar')
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/hyper-config.js') }}"></script>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    @stack('js')

</body>

</html>
