$(document).ready(function() {
    if ($('#calendar').length > 0) {
        $.getJSON('/events.json', function (json) {
            $('#calendar').fullCalendar({
                header: {

                    right: 'title prev,next today',
                    center: '',
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
                height: 1200,
                eventRender: function(event, element) {
                    console.log(event);
                    var toolTipTitle = event.title;

                    if (event._allDay !== true) {
                        toolTipTitle =
                            event.start._d.getHours() + ":" +
                            (event.start._d.getMinutes() < 10 ? "0" : "") + event.start._d.getMinutes() + " - " +
                            event.end._d.getHours() + ":" +
                            (event.end._d.getMinutes() < 10 ? "0" : "") + event.end._d.getMinutes() +
                            "<br><strong>" + toolTipTitle + "</strong>";
                    }

                    $(element).tooltip({
                        title: toolTipTitle,
                        html: true,
                        placement: 'bottom'
                    });
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