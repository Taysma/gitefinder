// $(document).ready(function () {
//     var arrivalDate;
//     var departureDate;

//     $('#date-arrive').click(function () {
//         $('#calendar').show();
//     });

//     $('#date-depart').click(function () {
//         $('#calendar').show();
//         $('#calendar').addClass('departure-mode'); // Ajouter une classe pour indiquer que le calendrier est en mode de sélection de date de départ
//     });

//     function initializeCalendar() {
//         // Inclure la bibliothèque Moment.js avec la locale française
//         $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js', function () {
//             // Charger la locale française
//             moment.locale('fr');

//             // Initialiser le calendrier
//             $('#calendar').fullCalendar({
//                 header: {
//                     left: 'prev,next',
//                     center: 'title',
//                     right: 'month,agendaWeek'
//                 },
//                 defaultView: 'month',
//                 selectable: true,
//                 select: function (start, end) {
//                     if ($('#calendar').hasClass('departure-mode')) { // Vérifier si le calendrier est en mode de sélection de date de départ
//                         departureDate = moment(end);
//                         $('#date-depart').val(departureDate.format('YYYY-MM-DD'));
//                     } else {
//                         arrivalDate = moment(start);
//                         $('#date-arrive').val(arrivalDate.format('YYYY-MM-DD'));
//                     }

//                     updateCalendar();
//                     $('#calendar').hide();
//                     $('#calendar').removeClass('departure-mode'); // Retirer la classe indiquant que le calendrier est en mode de sélection de date de départ
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
//                     $('#calendar').removeClass('departure-mode'); // Retirer la classe indiquant que le calendrier est en mode de sélection de date de départ
//                 },
//                 events: []
//             });

//             // Masquer le calendrier lors de l'initialisation
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

//     // Appeler initializeCalendar() lorsque le DOM est prêt
//     initializeCalendar();
// });

// hello
// $(document).ready(function () {
//     var arrivalDate;
//     var departureDate;

//     $('#date-arrive').click(function () {
//         $('#calendar').show();
//         $('#calendar').removeClass('departure-mode');
//     });

//     $('#date-depart').click(function () {
//         $('#calendar').show();
//         $('#calendar').addClass('departure-mode');
//     });

//     function initializeCalendar() {
//         $.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js', function () {
//             moment.locale('fr');

//             $('#calendar').fullCalendar({
//                 header: {
//                     left: 'prev,next',
//                     center: 'title',
//                     right: 'month,agendaWeek'
//                 },
//                 defaultView: 'month',
//                 selectable: true,
//                 select: function (start, end) {
//                     if ($('#calendar').hasClass('departure-mode')) {
//                         departureDate = moment(start);
//                         $('#date-depart').val(departureDate.format('YYYY-MM-DD'));
//                         $('#calendar').hide();
//                         $('#calendar').removeClass('departure-mode');
//                     } else {
//                         arrivalDate = moment(start);
//                         $('#date-arrive').val(arrivalDate.format('YYYY-MM-DD'));
//                         $('#calendar').hide(); // Hide the calendar here.
//                         setTimeout(function() {
//                             $('#date-depart').click();  // Trigger click on the departure date input after a delay.
//                         }, 0);
//                     }
//                 },
//                 dayRender: function (date, cell) {
//                     if (arrivalDate && departureDate && date.isBetween(arrivalDate, departureDate, 'day')) {
//                         cell.addClass('selected-range');
//                     }
//                 },
//                 unselect: function () {
//                     arrivalDate = null;
//                     departureDate = null;
//                     $('.selected-range').removeClass('selected-range');
//                     $('#calendar').hide();
//                     $('#calendar').removeClass('departure-mode');
//                 },
//                 events: []
//             });

//             $('#calendar').hide();
//         });
//     }

//     initializeCalendar();
// });



document.addEventListener("DOMContentLoaded", function () {
    let arrivalInput = document.getElementsByClassName("date-arrive");
    let departureInput = document.getElementsByClassName("date-depart");

    flatpickr(arrivalInput, {
        mode: "range",
        minDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates) {
            let [start, end] = selectedDates;
            arrivalInput.value = start ? start.toISOString().split('T')[0] : '';
            departureInput.value = end ? end.toISOString().split('T')[0] : '';
        }
    });
});







