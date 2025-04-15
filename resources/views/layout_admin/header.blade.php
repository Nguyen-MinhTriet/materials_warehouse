<style>
    .btn-eye {
        width: 40px;
        height: 38px;
        background: black;
        border: none;
        color: white;
        transition: background 0.5s, color 0.5s;
    }

    #modal-change-password {
        background-image: url({{ asset('storage/maintenance.svg') }});
        background-size: cover;
    }

    .modal-change-password-dialog {
        position: absolute;
        top: 10px;
        right: 370px;
        width: 400px;
    }
</style>
<link href="{{ asset('newcss/icons.min.css') }}" rel="stylesheet" type="text/css"/>
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">
            <button class="button-toggle-menu">
                <i class="uil-bars"></i>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="uil-bright font-22"></i>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="uil-sun font-22 d-none"></i>
                    <i class="uil-moon font-22"></i>
                </div>
            </li>

            <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-toggle="fullscreen" id="screen">
                    <i class="uil-focus font-22"></i>
                    <i class="uil-compress font-22 d-none"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src=""
                         class="rounded-circle" width="40" height="40">
                </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                    <h5 class="my-0">
                        Name
                    </h5>
                    <h6 class="my-0 fw-normal">
                        Role
                    </h6>
                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="#" class="dropdown-item">
                        <i class="uil-user-circle me-1"></i>
                        <span>
                            My Account
                        </span>
                    </a>

                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                            data-bs-target="#modal-change-password">
                        <i class="uil-lock-open-alt me-1"></i>
                        <span>
                        Reset Password
                    </span>
                    </button>

                    <a href="#" class="dropdown-item">
                        <i class="uil-sign-out-alt me-1"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // show hide
        $('.show-hide').click(function () {
            let passwordInput = $(this).siblings('input');
            let eyeSlashIcon = $(this).find('.uil-eye-slash');
            let eyeIcon = $(this).find('.uil-eye');

            passwordInput.attr('type', passwordInput.attr('type') === 'password' ? 'text' : 'password');
            let isPassword = passwordInput.attr('type') === 'password';
            eyeSlashIcon.toggleClass('d-none', isPassword);
            eyeIcon.toggleClass('d-none', !isPassword);
        });
    })
</script>
