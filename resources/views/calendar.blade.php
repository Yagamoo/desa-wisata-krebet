<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar TimeGrid</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js"></script>

    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <div id='calendar'></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Menggunakan tampilan TimeGrid untuk minggu
                selectable: true,
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false // Menggunakan format 24 jam
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false // Menggunakan format 24 jam
                },
                events: [
                    // Contoh event
                    {
                        title: 'Event Satu',
                        start: '2024-06-01T10:00:00',
                        end: '2024-06-01T12:00:00'
                    },
                    {
                        title: 'Event Dua',
                        start: '2024-06-07T14:00:00',
                        end: '2024-06-07T16:00:00'
                    },
                    {
                        title: 'Event Tiga',
                        start: '2024-06-09T09:00:00',
                        end: '2024-06-09T10:00:00'
                    }
                ]
            });

            calendar.render();
        });
    </script>
</body>
</html>
