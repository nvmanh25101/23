<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />

</head>

<body>
    <div id='calendar'></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script> --}}
    <script src="{{ asset('js/z.js') }}"></script>

    {{-- <script>
        setDefaults({
            allDaySlot: true,
            allDayText: 'Volledige dag',
            firstHour: 8,
            slotMinutes: 30,
            defaultEventMinutes: 120,
            axisFormat: 'HH:mm',
            timeFormat: {
                agenda: 'H:mm{ - h:mm}'
            },
            dragOpacity: {
                agenda: .5
            },
            minTime: 0,
            maxTime: 12
        }); --}}
    {{-- </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                editable: true,
                locale: 'vi-VN',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek'
                },
                events: [{
                    title: '1',
                    start: Date.now(),
                    allDay: false
                }],

            });
            calendar.render();
        });
    </script>
</body>

</html>
