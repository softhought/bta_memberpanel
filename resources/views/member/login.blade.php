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
            .captcha-box {
                display: flex !important;
                flex-direction: row !important;
            }
        }
    </style>
</head>

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
                            <div id="login_box">
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
                                            placeholder="Registration No. : Eg M12345" name="member_code"
                                            autocomplete="off" id="member_code">
                                        <div class="invalid-feedback d-block text-start px-2" id="member_code_error">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3" id="passerr">
                                        <label class="label" for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            autocomplete="off" name="password" id="password">
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
                                    <div class="invalid-feedback d-block text-start px-2 w-100" id="captcha_error">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="login_btn"
                                            class="form-control btn btn-light btn-rounded submit px-3"
                                            data-original-text="Sign In">Sign In</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="javascript:void(0);" class="text-primary" id="forgot_password_link"
                                        style="font-size: 14px;">Forgot Password?</a>
                                </div>
                            </div>

                            <!-- FORGOT PASSWORD -->
                            <div id="forgot_box" class="forgot-box d-none">
                                <h3 class="mb-4">Reset Password</h3>
                                <div id="forgot-step-1">
                                    <label for="forgot_reg_no">Enter Registration No.</label>
                                    <input type="text" id="forgot_reg_no" class="form-control mb-2"
                                        placeholder="Eg: M12345">
                                    <div class="text-danger small" id="forgot_reg_error"></div>
                                    <button type="button" class="form-control btn btn-light btn-rounded submit px-3"
                                        id="send_otp_btn" data-original-text="Send OTP">Send OTP</button>
                                </div>
                                <div id="forgot-step-2" style="display: none;">
                                    <div class="mb-2">OTP has been sent to: <strong
                                            id="masked_email">xxxxx***@gmail.com</strong></div>
                                    <label for="forgot_otp">Enter OTP</label>
                                    <input type="text" id="forgot_otp" placeholder="OTP"
                                        class="form-control mb-2">
                                    <div class="text-danger small" id="forgot_otp_error"></div>
                                    <button type="button" class="form-control btn btn-light btn-rounded submit px-3"
                                        id="verify_otp_btn" data-original-text="Verify OTP">Verify OTP</button>
                                </div>
                                <div id="forgot-step-3" style="display: none;">
                                    <label for="new_password">New Password</label>
                                    <input type="password" id="new_password" class="form-control mb-2">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" class="form-control mb-2">
                                    <div class="text-danger small" id="reset_error"></div>
                                    <button type="button" class="form-control btn btn-light btn-rounded submit px-3"
                                        id="reset_password_btn" data-original-text="Reset Password">Reset
                                        Password</button>
                                </div>
                            </div>
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
                    </p>
                    <p class="mb-0 footer-text">Legal Name: <strong>Bengal Tennis Association</strong></p>
                    <p class="footer-text">Yuba Bharati Krirangan, Street Number 2, beside Gate, JB Block, Sector 3,
                        Bidhannagar, Kolkata, West Bengal 700098</p>
                </div>
            </footer>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/app/js/cdn/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ vasset('assets/app/js/emp_login.js') }}"></script>

    <script>
        function showLoading(button) {
            const $btn = $(button);
            const originalText = $btn.html();
            $btn.data('original-text', originalText);
            $btn.prop('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i> Processing...`);
        }

        function hideLoading(button) {
            const $btn = $(button);
            $btn.prop('disabled', false).html($btn.data('original-text'));
        }

        $(document).ready(function() {
            let verifiedRegNo = "";
            let maskedEmail = "";

            $('#forgot_password_link').click(function() {
                $('#login_box').hide();
                $('#forgot_box').removeClass('d-none');
                $('#forgot-step-1').show();
                $('#forgot-step-2, #forgot-step-3').hide();
                $('#forgot_reg_no, #forgot_otp, #new_password, #confirm_password').val('');
                $('#forgot_reg_error, #forgot_otp_error, #reset_error').text('');
            });

            $('#send_otp_btn').click(function() {
                const regNo = $('#forgot_reg_no').val().trim();
                const btn = this;
                if (regNo === '') {
                    $('#forgot_reg_error').text('Please enter your Registration No.');
                    return;
                }
                showLoading(btn);
                $.post('{{ url('/ajax/send-otp') }}', {
                    member_code: regNo,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    hideLoading(btn);
                    if (response.status === 'success') {
                        verifiedRegNo = regNo;
                        maskedEmail = response.email_masked || 'xxxxx***@gmail.com';
                        $('#masked_email').text(maskedEmail);
                        $('#forgot-step-1').hide();
                        $('#forgot-step-2').show();
                    } else {
                        $('#forgot_reg_error').text(response.message ||
                            'Registration number not found.');
                    }
                }).fail(function() {
                    hideLoading(btn);
                    $('#forgot_reg_error').text('Something went wrong. Please try again.');
                });
            });

            $('#verify_otp_btn').click(function() {
                const otp = $('#forgot_otp').val().trim();
                const btn = this;
                if (otp === '') {
                    $('#forgot_otp_error').text('Please enter OTP.');
                    return;
                }
                showLoading(btn);
                $.post('{{ url('/ajax/verify-otp') }}', {
                    member_code: verifiedRegNo,
                    otp: otp,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    hideLoading(btn);
                    if (response.status === 'success') {
                        $('#forgot-step-2').hide();
                        $('#forgot-step-3').show();
                    } else {
                        $('#forgot_otp_error').text(response.message || 'Invalid OTP.');
                    }
                }).fail(function() {
                    hideLoading(btn);
                    $('#forgot_otp_error').text('Error verifying OTP.');
                });
            });

            $('#reset_password_btn').click(function() {
                const newPass = $('#new_password').val().trim();
                const confirmPass = $('#confirm_password').val().trim();
                const btn = this;

                if (newPass === '' || confirmPass === '') {
                    $('#reset_error').text('Both fields are required.');
                    return;
                }

                if (newPass !== confirmPass) {
                    $('#reset_error').text('Passwords do not match.');
                    return;
                }

                showLoading(btn);
                $.post('{{ url('/ajax/reset-password') }}', {
                    member_code: verifiedRegNo,
                    password: newPass,
                    _token: '{{ csrf_token() }}'
                }, function(response) {
                    hideLoading(btn);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Password reset successful. Please login again.',
                            confirmButtonColor: '#28a745'
                        }).then(() => {
                            $('#forgot_box').addClass('d-none');
                            $('#login_box').show();
                        });
                    } else {
                        $('#reset_error').text(response.message || 'Password reset failed.');
                    }
                }).fail(function() {
                    hideLoading(btn);
                    $('#reset_error').text('Something went wrong. Please try again.');
                });
            });

            $('#loginForm').submit(function(e) {
                e.preventDefault();
                const btn = $('#login_btn');
                showLoading(btn);
                // Place your login logic here. Don't forget to call `hideLoading(btn);` in success/error
                setTimeout(() => {
                    hideLoading(btn); // Simulate response
                }, 1500);
            });
        });
    </script>
</body>

</html>
