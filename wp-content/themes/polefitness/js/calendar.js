$(document).ready(function() {
    if ($('#calendar').length > 0) {
        $.getJSON('/events.json', function (json) {
            $('#calendar').fullCalendar({
                header: {

                    right: 'prev,next today',
                    center: 'title',
                    left: ''
                },
                customButtons: {
                    today: {
                        text: 'Idag',
                        click: function () {
                            $('#calendar').fullCalendar('today');
                        }
                    }
                },
                editable: false,
                defaultView: 'agendaWeek',
                firstDay: 1,
                dayNamesShort: ['Sön', 'Mån', 'Tis', 'Ons', 'Tors', 'Fre', 'Lör'],
                events: json,
                timeFormat: 'H:mm',
                slotLabelFormat: 'H:mm',
                minTime: '06:00',
                allDayText: ''
            });
        });
    }
});