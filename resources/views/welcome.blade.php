<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>UKM Musik ITS</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('homepage/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">UKM Musik ITS</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#persewaan">Persewaan</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#artikel">Artikel</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#hubungi-kami">Hubungi Kami</a></li>
                        @if (Session::has('login'))
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('user.index') }}">Profil Anda</a></li>
                            @if (Session::has('role'))
                                @if(Session::get('role') == "admin")
                                    <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('admin/logout') }}">Keluar</a></li>
                                @else
                                    <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('user/logout') }}">Keluar</a></li>
                                @endif
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-secondary" href="{{ route('registerUmum') }}">Register</a></li>
                        @endif
                        </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <p style="padding-bottom: 80%"></p>
                    {{-- <h1 class="mx-auto my-0 text-uppercase">Welcome</h1> --}}
                    <h2 class="text-white-50 mx-auto mt-2 mb-4">All-in-one platform untuk anggota aktif UKM Musik ITS maupun bukan anggota</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#hubungi-kami">Hubungi Kami</a>
                </div>
            </div>
        </header>
        <!-- Persewaan-->
        <section class="about-section text-center" id="persewaan">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="text-white mb-4">Persewaan Studio dan Alat Musik</h2>
                        @if (Session::has('login'))
                            <p class="text-white-50">
                                Silakan pilih menu <b>Studio</b> jika ingin menyewa studio, atau pilih menu <b>Alat Musik</b> apabila ingin menyewa
                                alat musik.
                            </p>
                        @else
                            <p class="text-white-50">
                                Untuk melakukan persewaan studio maupun alat musik, anda harus memiliki akun musikits.id. Apabila anda
                                tidak memiliki akun musikits.id, anda bisa
                                <a href="{{ route('registerUmum') }}">daftar akun sekarang.</a>
                            </p>
                        @endif
                        {{-- TODO: Tambahin href sewa studio sama alat musik --}}
                        <a class="btn btn-primary" href="{{ route('sewa.studio.index') }}">Studio </a>
                        <a class="btn btn-secondary" href="{{ route('sewa.alat.index') }}">Alat Musik </a>
                    </div>
                </div>
                <img class="img-fluid" src="{{ asset('homepage/assets/img/carousel.png') }}" alt="" />
            </div>
        </section>
        <!-- Artikel-->
        <section class="projects-section bg-light" id="artikel">
            <div class="container">
                <!-- Featured Artikel-->
                <h1 class="text-center text-black mb-2">Artikel</h1>
                <h5 class="text-center text-muted mb-4"><a href="{{ route('artikel.index') }}">Lihat semua artikel</a></h5>
                @foreach ($top as $top)
                    <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                        <div class="col-xl-8 col-lg-7"><img class="frameImg img-fluid mb-3 mb-lg-0" src="{{ url('Data/Informasi/' . $top->gambar) }}" alt="" /></div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="featured-text text-center text-lg-left mb-4">
                                <h4>{{ $top->nama }}}</h4>
                                <p class="text-black-50 mb-0">{{ $top->deskripsi }}</p>
                            </div>
                            <div class="featured-text-button text-center text-lg-left">
                                <a href="{{ route('artikel.show', $top->id) }}" class="btn btn-primary">Lanjut Baca</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Project Artikel terbaru-->
                @foreach ($artikels as $artikel)
                    @if ($loop->first)
                        <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                            <div class="col-lg-6"><img class="frameImg img-fluid" src="{{ url('Data/Informasi/' . $artikel->gambar) }}" alt="" /></div>
                            <div class="col-lg-6">
                                <div class="bg-black text-center h-100 project">
                                    <div class="d-flex h-100">
                                        <div class="project-text w-100 my-auto text-center text-lg-left">
                                            <h4 class="text-white">{{ $artikel->nama }}</h4>
                                            <p class="mb-0 text-white-50">{{ $artikel->subjudul }}</p>
                                            <hr class="d-none d-lg-block mb-4 ml-0" />
                                            <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-secondary">Lanjut Baca</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center no-gutters">
                            <div class="col-lg-6"><img class="frameImg img-fluid" src="{{ url('Data/Informasi/' . $artikel->gambar) }}" alt="" /></div>
                            <div class="col-lg-6 order-lg-first">
                                <div class="bg-black text-center h-100 project">
                                    <div class="d-flex h-100">
                                        <div class="project-text w-100 my-auto text-center text-lg-right">
                                            <h4 class="text-white">{{ $artikel->nama }}</h4>
                                            <p class="mb-0 text-white-50">{{ $artikel->deskripsi }}</p>
                                            <hr class="d-none d-lg-block mb-4 mr-0" />
                                            <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-secondary">Lanjut Baca</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
        <!-- Hubungi Kami-->
        <section class="contact-section" id="hubungi-kami">
            <div class="container">
                <h2 class="text-white mb-5 text-center">Hubungi Kami</h2>
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Studio</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">Kantin Pusat Institut Teknologi Sepuluh Nopember Surabaya</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="mailto:ukm.musikits@gmail.com">ukm.musikits@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Line</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">01hana001</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="https://twitter.com/ukm_musikITS"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="https://www.facebook.com/musik.its/"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="https://www.instagram.com/musikits/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © musikits.id 2021</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('homepage/js/scripts.js') }}"></script>
    </body>
</html>
