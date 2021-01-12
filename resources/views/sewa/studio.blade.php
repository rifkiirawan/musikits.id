<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Sewa Studio - UKM Musik ITS</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
    {{-- <link type="text/css" rel="stylesheet" href="{{ asset('sewa') }}/css/bootstrap.min.css" /> --}}
    <link href="{{ asset('homepage/css/styles.css') }}" rel="stylesheet" />

	<!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('sewa') }}/css/style.css" />
    <link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('fullcalendar/main.js') }}"></script>
    <script src="{{ asset('sewa') }}/js/sewa.js"></script>
    <style>
        #calendar {
            max-width: 90%;
            /* margin: 0 auto; */
            background-color: white;
            padding: 3% 3% 3% 3%;
            font-size: 10px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}">UKM Musik ITS</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if (Session::has('login'))
                        @if(Session::get('role') == "admin")
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('admin/home') }}">Profil Anda</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('admin/logout') }}">Keluar</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('user.index') }}">Profil Anda</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('user/logout') }}">Keluar</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-primary" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger font-weight-bold text-white bg-secondary" href="{{ route('registerUmum') }}">Register</a></li>
                    @endif
                    </ul>
            </div>
        </div>
    </nav>

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-8 col-md-push-4">
						<div class="booking-cta">
							<h1>Sewa Studio</h1>
							<p>Silakan isi form ini apabila anda ingin menyewa studio. Untuk jadwal ketersediaannya
                                anda dapat lihat di sini.
                            </p>
                            <input id="calendarData" data-eventroute="{{route('calendar.event')}}" type="hidden">
                            <div id="calendar"></div>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-8 align-self-center">
						<div class="booking-form">
						@if ($message = Session::get('sukses'))
							<div class="alert alert-success">
								{{$message}}
							</div>
						@elseif($message = Session::get('gagal'))
							<div class="alert alert-danger">
								{{$message}}
							</div>
						@endif
							<form role="form" action="{{ route('sewa.studio.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    			@csrf
                                <div class="form-group">
                                    <span class="form-label">Mulai</span>
                                    <input class="form-control" name="waktu_mulai" type="datetime-local" required>
                                </div>
                                <div class="form-group">
                                    <span class="form-label">Selesai
                                    </span>
                                    <input class="form-control" name="waktu_selesai" type="datetime-local" required>
                                </div>
								<div class="form-btn">
									<button class="submit-btn">Ajukan Sewa</button>
								</div>
							</form>
						</div>
					</div>
                </div>
			</div>
		</div>
    </div>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © musikits.id 2021</div></footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('homepage/js/scripts.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
