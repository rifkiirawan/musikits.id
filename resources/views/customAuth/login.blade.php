<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - UKM Musik ITS</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>
<body>
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">

            <div class="container">
            @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            <strong>Success:</strong> {{ Session::get('success') }}
        </div>
        @elseif (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('auth/images/signin-image.jpg') }}" alt="sing up image"></figure>
                        <p style="text-align: center;">
                            Buat akun sebagai
                            <br>
                            {{-- TODO: Href link daftar anggota atau umum --}}
                            <a href="/register-anggota" class="signup-image-link">Anggota</a> atau <a href="/register-umum" class="signup-image-link">Umum</a>
                        </p>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log In</h2>
                        {{-- TODO: Login POST --}}
                        <form method="POST" class="register-form" id="login-form" action="{{ route('post.login') }}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Email Anda"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="{{ asset('auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
