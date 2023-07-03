// $(document).ready(function () {
//     var arrivalDate;
//     var departureDate;

//     $('#date-arrive').click(function () {
//         $('#calendar').show();
//     });

//     $('#date-depart').click(function () {
//         $('#calendar').show();
//     });

//     function initializeCalendar() {
//         // Include the Moment.js library with French locale
//         $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js', function () {
//             // Load the French locale
//             moment.locale('fr');

//             // Initialize the calendar
//             $('#calendar').fullCalendar({
//                 header: {
//                     left: 'prev,next',
//                     center: 'title',
//                     right: 'month,agendaWeek'
//                 },
//                 defaultView: 'month',
//                 selectable: true,
//                 select: function (start, end) {
//                     arrivalDate = moment(start);
//                     departureDate = moment(end);

//                     $('#date-arrive').val(arrivalDate.format('YYYY-MM-DD'));
//                     $('#date-depart').val(departureDate.format('YYYY-MM-DD'));

//                     updateCalendar();
//                     $('#calendar').hide();
//                 },
//                 dayRender: function (date, cell) {
//                     if (arrivalDate && departureDate && date.isBetween(arrivalDate, departureDate, 'day', '[]')) {
//                         cell.addClass('selected-range');
//                     }
//                 },
//                 unselect: function () {
//                     arrivalDate = null;
//                     departureDate = null;

//                     $('.selected-range').removeClass('selected-range');

//                     $('#calendar').hide();
//                 },
//                 events: []
//             });

//             // Hide the calendar on initialization
//             $('#calendar').hide();
//         });
//     }

//     function updateCalendar() {
//         $('.selected-range').removeClass('selected-range');

//         if (arrivalDate && departureDate) {
//             var currentDate = moment(arrivalDate);
//             while (currentDate.isSameOrBefore(departureDate)) {
//                 var dateCell = $('.fc-day[data-date="' + currentDate.format('YYYY-MM-DD') + '"]');
//                 dateCell.addClass('selected-range');
//                 currentDate.add(1, 'day');
//             }
//         }
//     }

//     // Call initializeCalendar() once the DOM is ready
//     initializeCalendar();
// });




$(document).ready(function () {
    var arrivalDate;
    var departureDate;

    $('#date-arrive').click(function () {
        $('#calendar').show();
    });

    $('#date-depart').click(function () {
        $('#calendar').show();
        $('#calendar').addClass('departure-mode'); // Ajouter une classe pour indiquer que le calendrier est en mode de sélection de date de départ
    });

    function initializeCalendar() {
        // Inclure la bibliothèque Moment.js avec la locale française
        $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js', function () {
            // Charger la locale française
            moment.locale('fr');

            // Initialiser le calendrier
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'month,agendaWeek'
                },
                defaultView: 'month',
                selectable: true,
                select: function (start, end) {
                    if ($('#calendar').hasClass('departure-mode')) { // Vérifier si le calendrier est en mode de sélection de date de départ
                        departureDate = moment(end);
                        $('#date-depart').val(departureDate.format('YYYY-MM-DD'));
                    } else {
                        arrivalDate = moment(start);
                        $('#date-arrive').val(arrivalDate.format('YYYY-MM-DD'));
                    }

                    updateCalendar();
                    $('#calendar').hide();
                    $('#calendar').removeClass('departure-mode'); // Retirer la classe indiquant que le calendrier est en mode de sélection de date de départ
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
                    $('#calendar').removeClass('departure-mode'); // Retirer la classe indiquant que le calendrier est en mode de sélection de date de départ
                },
                events: []
            });

            // Masquer le calendrier lors de l'initialisation
            $('#calendar').hide();
        });
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

    // Appeler initializeCalendar() lorsque le DOM est prêt
    initializeCalendar();
});
