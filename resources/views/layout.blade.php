<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Kingfisher Admin Panel" />
    <meta name="keywords"
        content="Dashboard, Sales, Admin Dashboard, Tasks, Traffic, Activity, Deals, Invoices, Revenue, Projects, Orders, Posts, Admin, Dashboard, Bootstrap 4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest" />
    <meta name="author" content="Bootstrap Gallery" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets') }}/img/favicon.png" />

    <title>BTA Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/fonts/icomoon/icomoon.css" />

    <link rel="stylesheet" href="{{ vasset('assets/css/main.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/vendor/daterange/daterange.css" /> --}}


    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery-ui.css" />

    {{-- <link rel="stylesheet" href="{{ asset('assets') }}/css/datepicker.css" /> --}}

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/circliful/circliful.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/chartist/chartist.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/chartist/chartist-custom.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables/dataTables.bs4-custom.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/bootstrap-select/bootstrap-select.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/chat.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/summernote/summernote-bs4.css" />

    {{-- <script src="{{ asset('assets') }}/vendor/summernote/summernote-bs4.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets') }}/js/jquery.js"></script>

    <script src="{{ asset('assets') }}/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script src="{{ vasset('assets/app/js/ajaxsetup.js') }}"></script>
    <script src="{{ vasset('assets/app/js/common.js') }}"></script>


    <script src="{{ asset('assets') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/select2/select2.js"></script>

    <!-- Tether js, then other JS. -->
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/unifyMenu/unifyMenu.js"></script>
    <script src="{{ asset('assets') }}/vendor/onoffcanvas/onoffcanvas.js"></script>
    <script src="{{ asset('assets') }}/js/moment.js"></script>

    <!-- News Ticker JS -->
    <script src="{{ asset('assets') }}/vendor/newsticker/newsTicker.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/newsticker/custom-newsTicker.js"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('assets') }}/vendor/slimscroll/slimscroll.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/slimscroll/custom-scrollbar.js"></script>

    <!-- Daterange JS -->
    {{-- <script src="{{ asset('assets') }}/vendor/daterange/daterange.js"></script>
    <script src="{{ asset('assets') }}/vendor/daterange/custom-daterange.js"></script> --}}


    <script src="{{ asset('assets') }}/vendor/peity/peity.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/peity/custom-peity.js"></script>

    <!-- Circliful -->
    <script src="{{ asset('assets') }}/vendor/circliful/circliful.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/circliful/circliful.custom.js"></script>

    <!-- Chartist JS -->
    {{-- <script src="{{ asset('assets') }}/vendor/chartist/chartist.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/chartist/chartist-tooltip.js"></script>
    <script src="{{ asset('assets') }}/vendor/chartist/custom/custom-line-area.js"></script>
    <script src="{{ asset('assets') }}/vendor/chartist/custom/custom-line-area2.js"></script>
    <script src="{{ asset('assets') }}/vendor/chartist/custom/custom-multiline-bar.js"></script> --}}

    <!-- Common JS -->
    <script src="{{ asset('assets') }}/js/common.js"></script>

    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Custom Data tables JS -->
    <script src="{{ asset('assets') }}/vendor/datatables/custom/custom-datatables.js"></script>
    <script src="{{ asset('assets') }}/vendor/datatables/custom/fixedHeader.js"></script>

    {{-- <script src="{{ asset('assets') }}/vendor/libs/sweetalert2/sweetalert2.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>

    <script src="{{ asset('assets') }}/vendor/summernote/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>
</head>

@php
    use Illuminate\Support\Facades\Request;
    $slug = Request::segment(1);
    $session = $slug == 'admin' ? 'btaAdmin' : 'btaMember';
    $redirect = $session == 'btaAdmin' ? 'admin' : 'member';

    $btaAdmin = session()->get($session);
    $roleId = $btaAdmin['roleId'];
    $name = $btaAdmin['userName'];
    $role = $btaAdmin['role'];
@endphp

<body>
    <!-- Loading start -->
    <div id="loading-wrapper">
        <div id="loader"></div>
    </div>
    <!-- Loading end -->
    <input type="hidden" id="slug" name="slug" value="{{ $slug }}">

    <!-- BEGIN .app-wrap -->
    <div class="app-wrap" style="zoom: 90%">

        <!-- BEGIN .app-heading -->
        <header class="app-header">

            <!-- Container fluid starts -->
            <div class="container-fluid">

                <!-- Row start -->
                <div class="row gutters">
                    <div class="col-xl-7 col-lg-7 col-md-6 col-sm-7 col-7">

                        <!-- BEGIN .logo -->
                        <div class="logo-block">
                            <a class="mini-nav-btn" href="#" id="onoffcanvas-nav">
                                <i class="open"></i>
                                <i class="open"></i>
                                <i class="open"></i>
                            </a>
                            <a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler"
                                aria-expanded="true">
                                <i class="open"></i>
                                <i class="open"></i>
                                <i class="open"></i>
                            </a>
                        </div>

                        <div class="header-content">
                            BENGAL TENNIS ASSOCIATION
                        </div>

                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-5 col-5">

                        <!-- Header actions start -->
                        <ul class="header-actions">

                            <li class="dropdown">
                                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown"
                                    aria-haspopup="true">
                                    <span class="avatar">{{ getInitials(session("$session.userName")) }}<span
                                            class="status online"></span></span>
                                    <span class="user-name">{{ session("$session.userName") }}</span>
                                    <i class="icon-chevron-small-down downarrow"></i>
                                </a>
                                <div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
                                    <div class="admin-settings">
                                        <ul class="admin-settings-list">
                                            <li>
                                                <a href="{{ url("{$slug}/profile") }}">
                                                    <i class="fa-solid fa-user"></i>
                                                    <span class="text-name">Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url("{$slug}/changePassword") }}">
                                                    <i class="fa-solid fa-lock"></i>
                                                    <span class="text-name">Change Password</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="actions">
                                            <a href="{{ url('admin/logout') }}/{{ $roleId }}"
                                                class="btn btn-primary">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="app-container">
            <aside class="app-side fixed" id="app-side">
                <div class="side-content ">
                    <div class="sidebarNavScroll">

                        <nav class="side-nav">



                            <ul class="unifyMenu" id="unifyMenu">
                                {!! getTopNavCat($roleId, "$redirect/") !!}
                            </ul>

                        </nav>
                    </div>

                </div>

            </aside>

            <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
            <input type="hidden" name="admin_url" id="admin_url" value="{{ url('admin') }}">
            <script src="{{ vasset('assets/app/js/constant.js') }}"></script>

            <div class="app-main">
                <div class="main-content" id="mainContainer">
                    <div id="global-tab-loader" class="tab-loader">
                        <div class="lottie-loader" id="lottie-global"></div>
                    </div>
                    {!! $bodyView !!}
                </div>

                <div class="bs-toast toast toast-success toast-ex animate__animated my-2" style="display: none;"
                    role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
                    <div class="toast-header">
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body d-inline-flex " id="toast_body_content">

                    </div>
                </div>

                <x-modal-layout id="commonModal" title="BTA" dialogclass="modal-lg modal-dialog-centered"
                    bodyclass="an-box-shadow">

                </x-modal-layout>


                <x-modal-full id="commonFullModal" title="BTA" dialogclass="modal-lg modal-dialog-centered"
                    bodyclass="an-box-shadow">

                </x-modal-full>

                @if ($forceChangePassword)
                    {{-- <style>
                        .custom-modal {
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.5);
                            z-index: 1050;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .custom-modal-content {
                            background: #fff;
                            padding: 30px;
                            border-radius: 8px;
                            width: 100%;
                            max-width: 500px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
                            position: relative;
                        }

                        .custom-modal h4 {
                            margin-top: 0;
                            font-weight: bold;
                            margin-bottom: 20px;
                        }

                        .custom-modal .form-group {
                            margin-bottom: 15px;
                        }

                        .custom-modal-actions {
                            text-align: right;
                        }
                    </style>
                    <div id="customChangePasswordModal" class="custom-modal">
                        <div class="custom-modal-content">
                            <h4>Change Your Password</h4>


                            <form id="forceChangePasswordForm" method="POST">
                                <div class="row">
                                    <x-input-component column="col-md-12" type="password" label="New Password"
                                        name="new_password" id="new_password" class="custom-input-class"
                                        placeholder="Enter New Password" value="" readonly="" />

                                    <x-input-component column="col-md-12" type="password" label="Confirm Password"
                                        name="confirm_password" id="confirm_password" class="custom-input-class"
                                        placeholder="Enter Confirm Password" value="" readonly="" />
                                </div>

                                <div class="custom-modal-actions">
                                    <button type="submit" id="savebtn" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#customChangePasswordModal').fadeIn();

                            ajaxCall('forceChangePasswordForm', 'forceChangePassword', function(response) {
                                showToast(response.message);
                                window.location.href = '{{ url('admin/logout/2') }}';
                            });
                        });
                    </script> --}}
                @endif


            </div>

            <div style="height: 200px"></div>

            <footer
                style="position: fixed; bottom: 0; left: 0; width: 100%; background: #fff; text-align: center; padding: 10px; box-shadow: 0 -1px 5px rgba(0,0,0,0.1); z-index: 999;">
                <p style="margin: 0;">BTA ©2025 All Rights Reserved</p>
                <p style="margin: 5px 0;">
                    <a href="{{ url('/about-us') }}" class="footer-text" target="_blank"
                        style="text-decoration: none; color: #000;">About Us</a> |
                    <a href="{{ url('/contact-us') }}" class="footer-text" target="_blank"
                        style="text-decoration: none; color: #000;">Contact Us</a> |
                    <a href="{{ url('/privacy-policy') }}" class="footer-text" target="_blank"
                        style="text-decoration: none; color: #000;">Privacy Policy</a> |
                    <a href="{{ url('/terms-and-conditions') }}" class="footer-text" target="_blank"
                        style="text-decoration: none; color: #000;">Terms & Conditions</a>
                </p>
                <p style="margin: 0;">Yuba Bharati Krirangan, Street Number 2, beside Gate, JB Block, Sector 3,
                    Bidhannagar, Kolkata, West Bengal 700098</p>
            </footer>

        </div>
    </div>
</body>


<script src="{{ vasset('assets/app/js/ajaxsetup.js') }}"></script>
<script src="{{ vasset('assets/app/js/common.js') }}"></script>

<!-- News Ticker JS -->
<script src="{{ asset('assets') }}/vendor/newsticker/newsTicker.min.js"></script>
<script src="{{ asset('assets') }}/vendor/newsticker/custom-newsTicker.js"></script>

</html>
