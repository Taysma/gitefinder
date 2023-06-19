$(document).ready(function () {
    var arrivalDate = $('#date-arrive');
    var departureDate = $('#date-depart');
    var calendar = $('#calendar');
    var selectedRangeCells = $('.selected-range');

    calendar.hide(); // Cacher le calendrier initialement

    arrivalDate.click(function (e) {
        e.stopPropagation();
        calendar.show();
    });

    departureDate.click(function (e) {
        e.stopPropagation();
        calendar.show();
    });

    $(document).click(function () {
        calendar.hide();
    });

    calendar.click(function (e) {
        e.stopPropagation();
    });

    function initializeCalendar() {
        calendar.fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek'
            },
            defaultView: 'month',
            selectable: true,
            select: function (start, end) {
                arrivalDate.val(moment(start).format('YYYY-MM-DD'));
                departureDate.val(moment(end).format('YYYY-MM-DD'));

                updateCalendar();
                calendar.hide();
            },
            dayRender: function (date, cell) {
                if (arrivalDate.val() && departureDate.val() && date.isBetween(arrivalDate.val(), departureDate.val(), 'day', '[]')) {
                    cell.toggleClass('selected-range', true);
                }
            },
            unselect: function () {
                arrivalDate.val('');
                departureDate.val('');

                selectedRangeCells.removeClass('selected-range');

                calendar.hide();
            },
            events: []
        });
    }

    function updateCalendar() {
        selectedRangeCells.removeClass('selected-range');

        var currentDate = moment(arrivalDate.val());
        var endDate = moment(departureDate.val());

        while (currentDate.isSameOrBefore(endDate)) {
            var dateCell = $('.fc-day[data-date="' + currentDate.format('YYYY-MM-DD') + '"]');
            dateCell.toggleClass('selected-range', true);
            currentDate.add(1, 'day');
        }
    }

    // Appeler la fonction initializeCalendar une fois que le DOM est prêt
    initializeCalendar();
});








