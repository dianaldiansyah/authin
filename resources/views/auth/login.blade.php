<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <title>Authin - Login</title>

        <style>
            .msg {
                font-size: 14px;
                font-family: 'Roboto'
            }
            .msg--error {
                color: red
            }
        </style>
    </head>

    <body>
        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');"></div>
            <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Login to <strong>Authin </strong></h3>
                    <p class="mb-4">Belum punya akun?. <a href="{{ url('/register') }}">Register</a>.</p>
                    <form class="form-auth">
                        <div class="form-group first">
                            <label for="username">Username</label>
                            <input type="text" class="form-control username" placeholder="Your Username">
                            <span class="msg msg-username"></span>
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control password" placeholder="Your Password">
                            <span class="msg msg-password"></span>
                        </div>
                        
                        <div class="d-flex mb-5 align-items-center">
                            {{-- <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                            <input type="checkbox" checked="checked"/>
                            <div class="control__indicator"></div>
                            </label>
                            <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  --}}
                        </div>

                        <button type="button" class="btn btn-block btn-primary btn-submit">
                            Login
                        </button>

                    </form>
                </div>
                </div>
            </div>
            </div>

            
        </div>
            
        <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script>
            function validateUsername(username) {
                if (username == "") {
                    return "Please enter your username";
                }
                return false;
            }

            function validatePassword(password) {
                if (password == "") {
                    return 'Please enter a password';
                } else {
                    if (password.length < 10) {
                        return 'Password must be less than 10 characters.';
                    }
                    else if (!(/^(?=.*[A-Z])/.test(password))) {
                        return 'Password must contain at least one uppercase.';
                    }
                    else if (!(/^(?=.*[a-z])/.test(password))) {
                        return 'Password must contain at least one lowercase.';
                    }
                    else if (!(/^(?=.*[0-9])/.test(password))) {
                        return 'Password must contain at least one digit.';
                    }
                    else if (!(/^(?=.*[@#$%&!])/.test(password))) {
                        return "Password must contain special characters from @#$%&!.";
                    }
                }

                return false;
            }

            $(".btn-submit").click(function() {
                $(".msg-username").html("");
                $(".msg-password").html("");
                $(".msg-username").removeClass("msg--error");
                $(".msg-password").removeClass("msg--error");

                let username = $(".username").val();
                let password = $(".password").val();

                if (validateUsername(username)) {
                    $(".msg-username").html(validateUsername(username));
                    $(".msg-username").addClass("msg--error");
                }

                if (validatePassword(password)) {
                    $(".msg-password").html(validatePassword(password));
                    $(".msg-password").addClass("msg--error");
                }

                if (!validateUsername(username) && !validatePassword(password)) {
                    $.ajax({   
                        url: "/validate-login",
                        type: 'POST',
                        data: {
                            username: username,
                            password: password,
                        },
                        success: function(response) {
                            if (!response.error) {
                                window.location.href = "/";
                            } else {
                                alert(response.msg);
                            }
                        }
                    });
                }
            })
        </script>
    </body>
</html>