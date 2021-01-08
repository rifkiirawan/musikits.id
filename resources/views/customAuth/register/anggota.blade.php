<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name') }}</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('auth/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Daftar sebagai Anggota</h2>
                        {{-- TODO: POST tergantung controller --}}
                        {{-- TOOD: Kasih value anggota --}}
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="nama"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama" id="nama" placeholder="Nama Pengguna"/>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="zmdi zmdi-home material-icons-home"></i></label>
                                <input type="text" name="alamat" id="alamat" placeholder="Alamat"/>
                            </div>
                            <div class="form-group">
                                <label for="notelp"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="notelp" id="notelp" placeholder="Nomor Telepon"/>
                            </div>
                            <div class="form-group">
                                <label for="idLine"><i class="zmdi zmdi-smartphone-android"></i></label>
                                <input type="text" name="idLine" id="idLine" placeholder="ID Line"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email Anda"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Ulangi Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Daftar"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('auth/images/signup-image.jpg') }}" alt="sing up image"></figure>
                        {{-- TODO: Href ke login --}}
                        <a href="#" class="signup-image-link">Saya telah terdaftar</a>
                    </div>
                </div>
            </div>
        </section>
    <!-- JS -->
    <script src="{{ asset('auth/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
