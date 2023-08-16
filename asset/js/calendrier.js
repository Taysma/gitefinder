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



// document.addEventListener("DOMContentLoaded", function () {
//     let arrivalInputs = document.getElementsByClassName("date-arrive");
//     let departureInputs = document.getElementsByClassName("date-depart");

//     for (let i = 0; i < arrivalInputs.length; i++) {
//         flatpickr(arrivalInputs[i], {
//             mode: "range",
//             minDate: "today",
//             dateFormat: "Y-m-d",
//             onClose: function (selectedDates) {
//                 let [start, end] = selectedDates;
//                 arrivalInputs[i].value = start ? start.toISOString().split('T')[0] : '';
//                 if (departureInputs[i]) {
//                     departureInputs[i].value = end ? end.toISOString().split('T')[0] : '';
//                 }
//             }
//         });
//     }
// });


document.addEventListener("DOMContentLoaded", function () {
    const DATE_FORMAT = "d-m-Y";
    const arrivalInputs = document.querySelectorAll(".date-arrive");
    const departureInputs = document.querySelectorAll(".date-depart");

    arrivalInputs.forEach((arrivalInput, i) => {
        const departureInput = departureInputs[i];

        flatpickr(arrivalInput, {
            mode: "range",
            minDate: "today",
            dateFormat: DATE_FORMAT,
            onClose: function (selectedDates) {
                const [start, end] = selectedDates;

                // Remplissez l'input d'arrivée avec la date de début et l'input de départ avec la date de fin.
                arrivalInput.value = start ? formatDateToDigits(start) : '';
                departureInput.value = end ? formatDateToDigits(end) : '';

                // Si une date de début est sélectionnée mais pas de date de fin, ouvrez à nouveau le calendrier pour que l'utilisateur puisse choisir une date de fin.
                if (start && !end) {
                    this.open();
                }
            }
        });

        // Lorsque l'utilisateur clique sur l'input de départ, ouvrez le calendrier associé à l'input d'arrivée.
        departureInput.addEventListener("focus", function () {
            arrivalInput._flatpickr.open();
        });
    });

    function formatDateToDigits(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

});



// document.addEventListener("DOMContentLoaded", function () {
//     let arrivalInputs = document.getElementsByClassName("date-arrive");
//     let departureInputs = document.getElementsByClassName("date-depart");

//     for (let i = 0; i < arrivalInputs.length; i++) {
//         flatpickr(arrivalInputs[i], {
//             mode: "range",
//             minDate: "today",
//             dateFormat: "d-m-y",
//             onClose: function (selectedDates) {
//                 let [start, end] = selectedDates;

//                 // Format and set the arrival date
//                 if (start) {
//                     let day = start.getDate().toString().padStart(2, '0');
//                     let month = (start.getMonth() + 1).toString().padStart(2, '0');
//                     let year = start.getFullYear();
//                     arrivalInputs[i].value = `${day}-${month}-${year}`;
//                 } else {
//                     arrivalInputs[i].value = '';
//                 }

//                 // Format and set the departure date
//                 if (end && departureInputs[i]) {
//                     let day = end.getDate().toString().padStart(2, '0');
//                     let month = (end.getMonth() + 1).toString().padStart(2, '0');
//                     let year = end.getFullYear();
//                     departureInputs[i].value = `${day}-${month}-${year}`;
//                 } else if (departureInputs[i]) {
//                     departureInputs[i].value = '';
//                 }
//             }
//         });

//         if (departureInputs[i]) {
//             departureInputs[i].addEventListener("focus", function () {
//                 let startDate = new Date(arrivalInputs[i].value.split("-").reverse().join("-"));
//                 let endDate = departureInputs[i].value ? new Date(departureInputs[i].value.split("-").reverse().join("-")) : null;

//                 flatpickr(departureInputs[i], {
//                     mode: "range",
//                     minDate: startDate || "today",
//                     defaultDate: [startDate, endDate || startDate],
//                     dateFormat: "d-m-y",
//                     onClose: function (selectedDates) {
//                         if (selectedDates[1]) {  // Update only the end date
//                             let day = selectedDates[1].getDate().toString().padStart(2, '0');
//                             let month = (selectedDates[1].getMonth() + 1).toString().padStart(2, '0');
//                             let year = selectedDates[1].getFullYear();
//                             departureInputs[i].value = `${day}-${month}-${year}`;
//                         }
//                     }
//                 }).open();
//             });
//         }
//     }
// });