document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    let eventRoute = document.getElementById('calendarData').dataset.eventroute;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'Asia/Jakarta',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      locale: 'id',
      events: eventRoute,
      displayEventEnd: true,
      eventDisplay: 'auto',
      dayMaxEvents: true, // allow "more" link when too many events
    });
    calendar.render();
  });
