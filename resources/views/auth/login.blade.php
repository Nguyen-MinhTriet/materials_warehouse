<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />


    {{-- <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />

    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .auth-fluid {
            background-image: url({{ asset('assets/system/truongdhkg.jpg') }});
        }
    </style>
</head>

<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="" class="logo-dark">
                        <span><img src="{{ asset('assets/system/logo.webp') }}" alt="dark logo" height="100"></span>
                    </a>

                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">Đăng Nhập</h4>
                    {{-- <p class="text-muted mb-4">Nhâp địa chỉ email và Mật khẩu để đăng nhập vào tài khoản.</p> --}}

                    <!-- form -->
                    <form method="POST" action="{{ route('process_login') }}">
                        {{-- <form method="POST" action=""> --}}
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email </label>
                            <input class="form-control" type="email" id="emailaddress" required="" name="email"
                            placeholder="Nhập email" value="{{ old('email') }}">
                            
                            @error('email')
                                {{-- <p class="error">{{ $message }}</p> --}}
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- <a href="pages-recoverpw-2.html" class="text-muted float-end"><small>Forgot your password?</small></a> --}}
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input class="form-control" type="password" required="" name="password" id="password"
                                placeholder="Nhập mật khẩu">
                            {{-- @error('password')
                            <p class="error"> {{ $message }}</p>
                               
                            @enderror --}}
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label" for="checkbox-signin">Ghi nhớ </label>
                            </div>
                        </div>
                        @error('fieled')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-sign-in-alt"></i> Đăng
                                nhập</button>
                        </div>
                        <!-- social-->
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Sign in with</p>
                        </div>
                    </form>
                    <!-- end form-->
                </div>

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Bạn chưa có tài khoản? <a href="{{ route('register') }}"
                            class="text-muted ms-1"><b>Sign Up</b></a></p>
                    {{-- <p class="text-muted">Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-muted ms-1"><b>Sign Up</b></a></p> --}}
                </footer>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
