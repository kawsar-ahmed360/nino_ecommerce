<!doctype html>
<html lang="en">

<!-- Mirrored from bootstrap.gallery/le-rouge/design/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Oct 2021 11:48:46 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="img/fav.png" />

    <!-- Title -->
    <title>Nino Admin Template - Login</title>

    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap CSS -->
    {{--{{asset('backend/css/main.css')}}--}}
{{--    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}" />--}}

    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/main.css')}}">

</head>

<body class="authentication">

<!-- Container start -->
<div class="container">

    @isset($url)
    <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
        @else
            {{--<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">--}}
                @endisset
                @csrf
        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="#" class="login-logo">
                            <img style="width: 77px;" src="{{asset('backend/login.png')}}" alt="" />
                        </a>

                        <input type="hidden" value="superadmin" name="super">
                        <h5>Welcome back,<br />Super Admin Login Panel,Please Login.</h5>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="actions mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember_pwd">
                                {{--<label class="custom-control-label" for="remember_pwd">Remember me</label>--}}
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="forgot-pwd">
                            {{--<a class="link" href="forgot-pwd.html">Forgot password?</a>--}}
                        </div>
                        <hr>
                        <div class="actions align-left">
                            {{--<span class="additional-link">New here?</span>--}}
                            {{--<a href="signup.html" class="btn btn-dark">Create an Account</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Container end -->

</body>

<!-- Mirrored from bootstrap.gallery/le-rouge/design/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Oct 2021 11:48:46 GMT -->
</html>