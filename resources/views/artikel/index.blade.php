<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Artikel - UKM Musik ITS</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('artikel') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('artikel') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{ asset('artikel') }}/css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">UKM Musik ITS</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            @if (Session::has('login'))
                {{-- TODO: Nambah route ke profil anda --}}
                <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="">Profil Anda</a></li>
            @else
                <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary mx-4" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-secondary" href="{{ route('registerUmum') }}">Register</a></li>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('{{ asset('artikel') }}/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog Musik ITS</h1>
            <span class="subheading">Cari artikel atau kegiatan Musik ITS disini.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
          @foreach ($artikels as $artikel)
            <div class="post-preview">
                <a href="{{ route('artikel.show', $artikel->id) }}">
                <h2 class="post-title">
                    {{ $artikel->nama }}
                </h2>
                <h3 class="post-subtitle">
                    {{ $artikel->subjudul }}
                </h3>
                </a>
                <p class="post-meta">{{ $artikel->tipe }}</b> ini terbit pada
                    {{ $artikel->created_at }}</p>
            </div>
          @endforeach
        <hr>
        <!-- Pager -->
        <div class="d-flex justify-content-right">
            {{ $artikels->links() }}
        </div>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('artikel') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('artikel') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('artikel') }}/js/clean-blog.min.js"></script>

</body>

</html>
