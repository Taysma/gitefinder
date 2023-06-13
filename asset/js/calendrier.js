$(document).ready(function () {
    var arrivalDate;
    var departureDate;

    $('#arrival').click(function () {
        $('#calendar').show();
    });

    $('#departure').click(function () {
        $('#calendar').show();
    });

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

            $('#arrival').val(arrivalDate.format('YYYY-MM-DD'));
            $('#departure').val(departureDate.format('YYYY-MM-DD'));

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
});