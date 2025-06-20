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

<body>
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
                                    <h3 class="mb-4">Admin Sign In</h3>
                                </div>

                            </div>
                            <form class="loginForm" name="loginForm" id="loginForm" method="POST">
                                @csrf
                                <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
                                <div class="invalid-feedback d-block text-center mb-4" id="errormsg"
                                    style="font-weight: 600;letter-spacing: 0.4px;"></div>

                                <div class="form-group mb-3" id="usererr">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" class="form-control" placeholder="Username"
                                        name="username" id="username">
                                    <div class="invalid-feedback d-block text-start px-2" id="username_error"></div>
                                </div>

                                <div class="form-group mb-3" id="passerr">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password"
                                        name="password" id="password">
                                    <div class="invalid-feedback d-block text-start px-2" id="password_error"></div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="login_btn"
                                        class="form-control btn btn-light btn-rounded submit px-3">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/app/js/cdn/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ vasset('assets/app/js/login.js') }}"></script>
</body>

</html>
