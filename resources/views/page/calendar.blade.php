<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' />
<script src="{{ asset('fullcalendar/main.js') }}"></script>
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
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>
</head>
<body>
      <input id="calendarData" data-eventroute="{{route('calendar.event')}}" type="hidden">
      <div id="calendar"></div>
</body>

</html>
