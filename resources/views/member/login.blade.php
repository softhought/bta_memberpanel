<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/img/favicon.png" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/login/css/style.css">

</head>

<style>
    footer a {
        color: #007bff;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .footer-text {
        color: #09343e;
        font-weight: bold;
    }

    .captcha-box {
        gap: 0.5rem;
        position: relative;
    }

    .captcha-display {
        width: 145px;
        font-weight: bold;
        background: #fff;
        border: 1px solid #ccc;
        font-size: 18px;
        pointer-events: none;
    }

    .captcha-input {
        width: 145px;
        background: #fff;
        border: 1px solid #ccc;
        font-size: 18px;
    }

    .btn-refresh {
        background-color: #f7297f;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        width: 40px;
        transition: background 0.3s ease;
    }

    .btn-refresh:hover {
        background-color: #c91c64;
    }

    #captcha_error {
        margin-top: -18px;
        margin-bottom: 8px;
        height: 20px;
    }

    @media (max-width: 576px) {
        .captcha-box{
            display: flex !important;
            flex-direction: row !important;
        }
    }
</style>


<body style="zoom: 90%;">
    <section class="ftco-section">
        <div class="container" style="height: 2rem;">
            <div class="row justify-content-center" style="margin-top: -4rem;">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <h2>Welcome to BTA</h2>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Student Sign In</h3>
                                </div>

                            </div>
                            <form class="loginForm" name="loginForm" id="loginForm" method="POST">
                                @csrf
                                <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
                                <div class="invalid-feedback d-block text-center mb-4" id="errormsg"
                                    style="font-weight: 600;letter-spacing: 0.4px;"></div>

                                <div class="form-group mb-3" id="usererr">
                                    <label class="label" for="name">Registration No.</label>
                                    <input type="text" class="form-control"
                                        placeholder="Registration No. : Eg M12345" name="member_code" autocomplete="off" id="member_code">
                                    <div class="invalid-feedback d-block text-start px-2" id="member_code_error"></div>
                                </div>

                                <div class="form-group mb-3" id="passerr">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" autocomplete="off" name="password"
                                        id="password">
                                    <div class="invalid-feedback d-block text-start px-2" id="password_error"></div>
                                </div>

                                <div
                                    class="form-group mb-3 captcha-box d-flex align-items-center justify-content-center">
                                    <input type="text" class="form-control text-center captcha-display"
                                        id="math_question" readonly />

                                    <button type="button" class="btn btn-refresh mx-2" id="refresh_captcha"
                                        aria-label="Refresh Captcha">
                                        <i class="fa fa-refresh text-white"></i>
                                    </button>

                                    <input type="text" class="form-control onlynumber text-center captcha-input"
                                        id="captcha_answer" placeholder="Answer" autocomplete="off">
                                </div>
                                <div class="invalid-feedback d-block text-start px-2 w-100" id="captcha_error"></div>


                                <div class="form-group">
                                    <button type="submit" id="login_btn"
                                        class="form-control btn btn-light btn-rounded submit px-3">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="text-center mt-2 p-3" style="font-size: 14px; background: #70d45b;">
                <div class="container">
                    <p class="mb-1">
                        <a href="{{ url('/about-us') }}" class="mx-2 footer-text" target="_blank">About Us</a> |
                        <a href="{{ url('/contact-us') }}" class="mx-2 footer-text" target="_blank">Contact Us</a> |
                        <a href="{{ url('/privacy-policy') }}" class="mx-2 footer-text" target="_blank">Privacy
                            Policy</a> |
                        <a href="{{ url('/terms-and-conditions') }}" class="mx-2 footer-text" target="_blank">Terms &
                            Conditions</a>
                        {{-- <a href="{{ url('/refund-policy') }}" class="mx-2 footer-text" target="_blank">Refund Policy</a> --}}
                    </p>
                    <p class="mb-0 footer-text">Legal Name: <strong>Bengal Tennis Association</strong></p>
                    <p class="footer-text">Yuba Bharati Krirangan, Street Number 2, beside Gate, JB Block, Sector 3,
                        Bidhannagar, Kolkata, West Bengal 700098</p>
                </div>
            </footer>
        </div>
    </section>



    <script src="{{ asset('assets/app/js/cdn/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ vasset('assets/app/js/emp_login.js') }}"></script>
</body>

</html>
