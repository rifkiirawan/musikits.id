@extends('admin/section/app')
@section('stylesheets')
<link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' />
<script src="{{ asset('fullcalendar/main.js') }}"></script>
<style>

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>KALENDER SEWA ALAT</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Sewa Alat</li>
                <li class="breadcrumb-item text-blue"><a href="{{ route('calendar-booking-stuff') }}">Kalender Sewa Alat</a></li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </div>

    {{-- main content --}}
    <section class="content">
        <div class="card">
        <div class="card-header">
          @if ($message = Session::get('sukses'))
            <div class="alert alert-success">
                {{$message}}
            </div>
          @elseif($message = Session::get('gagal'))
            <div class="alert alert-danger">
                {{$message}}
            </div>
          @endif
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
            <!-- /.card-header -->
            <div class="card-body">
            <input id="calendarData" data-eventroute="{{route('calendar.alat.event')}}" type="hidden">
            <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    let eventRoute = document.getElementById('calendarData').dataset.eventroute;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'Asia/Jakarta',
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      locale: 'id',
      events: eventRoute,
      displayEventEnd: true,
      eventDisplay: 'block',
      dayMaxEvents: true, // allow "more" link when too many events
    });
    calendar.render();
  });
</script>
@endsection