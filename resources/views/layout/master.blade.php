<!DOCTYPE html>
<html lang="en" data-sidenav-size="fullscreen">

<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="#">
    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />

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
                            <div class="page-title-box">
                                
                                <h4 class="page-title">{{ $title }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="col-12">
                                <div class="alert alert-success">
                                    
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif
                        
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/hyper-config.js') }}"></script>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    
    @stack('js')

</body>

</html>
