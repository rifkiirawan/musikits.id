<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Sewa Studio - {{ config('app.name') }}</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('sewa') }}/css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('sewa') }}/css/style.css" />
    <link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('fullcalendar/main.js') }}"></script>
    <script src="{{ asset('sewa') }}/js/sewa.js"></script>
    <style>
        #calendar {
            max-width: 80%;
            /* margin: 0 auto; */
            background-color: white;
            padding: 3% 3% 3% 3%;
            font-size: 10px;
        }
    </style>
</head>

<body>

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">
							<h1>Sewa Studio</h1>
							<p>Silakan isi form ini apabila anda ingin menyewa studio. Untuk jadwal ketersediaannya
                                anda dapat lihat di sini.
                            </p>
                            <input id="calendarData" data-eventroute="{{route('calendar.event')}}" type="hidden">
                            <div id="calendar"></div>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-7">
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
                            {{-- TODO: Form POST belum --}}
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
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
