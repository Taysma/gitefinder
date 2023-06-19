$(document).ready(function () {
    var arrivalDate;
    var departureDate;

    $('#date-arrive').click(function () {
        $('#calendar').show();
    });

    $('#date-depart').click(function () {
        $('#calendar').show();
    });

    function initializeCalendar() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek'
            },
            defaultView: 'month',
            selectable: true,
            select: function (start, end) {
                arrivalDate = moment(start);
                departureDate = moment(end);

                $('#date-arrive').val(arrivalDate.format('YYYY-MM-DD'));
                $('#date-depart').val(departureDate.format('YYYY-MM-DD'));

                updateCalendar();
                $('#calendar').hide();
            },
            dayRender: function (date, cell) {
                if (arrivalDate && departureDate && date.isBetween(arrivalDate, departureDate, 'day', '[]')) {
                    cell.addClass('selected-range');
                }
            },
            unselect: function () {
                arrivalDate = null;
                departureDate = null;

                $('.selected-range').removeClass('selected-range');

                $('#calendar').hide();
            },
            events: []
        });

        // Cacher le calendrier au chargement
        $('#calendar').hide();
    }

    function updateCalendar() {
        $('.selected-range').removeClass('selected-range');

        if (arrivalDate && departureDate) {
            var currentDate = moment(arrivalDate);
            while (currentDate.isSameOrBefore(departureDate)) {
                var dateCell = $('.fc-day[data-date="' + currentDate.format('YYYY-MM-DD') + '"]');
                dateCell.addClass('selected-range');
                currentDate.add(1, 'day');
            }
        }
    }

    // Appeler la fonction initializeCalendar une fois que le DOM est prêt
    initializeCalendar();
});
