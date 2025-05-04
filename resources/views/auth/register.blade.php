<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DangKy</title>
    {{-- <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />

    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
      .auth-fluid{
        background-image: url({{ asset('assets/system/truongdhkg.jpg')}}) ;

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
                    <a href="index.html" class="logo-dark">
                        <span><img src="{{ asset('assets/system/logo.webp')  }}" alt="dark logo" height="50"></span>
                    </a>

                </div>
                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-3">Đăng Ký tài khoản</h4>
                    {{-- <p class="text-muted mb-4">Nhập Mật khẩu và Email </p> --}}
                    <!-- form -->
                    <form method="post" action="{{ route('process_register') }}">
                      @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ Tên</label>
                            <input class="form-control" type="text" name="name" placeholder="Nhập họ tên" >
                        </div>
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Nhập Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="mb-3">
                            <label for="laevel" class="form-label">Level</label>
                            <input class="form-control" type="text" name="level" placeholder="chuc vu">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                {{-- <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a></label> --}}
                            </div>
                        </div>
                        <div class="mb-0 d-grid text-center">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-user-circle"></i>Đăng Ký </button>
                        </div>
                      
                    </form>
                    <!-- end form-->
                </div>

            </div> 
        </div>

    </div>
    
</body>
</html>