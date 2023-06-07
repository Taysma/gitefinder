// Fonction pour créer le calendrier
function creerCalendrier(element) {
    var calendrier = document.createElement('div');
    calendrier.className = 'calendrier';

    // Création du calendrier avec des données de démonstration
    var mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    var joursSemaine = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

    var table = document.createElement('table');

    // Création de l'en-tête du calendrier avec les noms des jours de la semaine
    var thead = document.createElement('thead');
    var tr = document.createElement('tr');

    for (var i = 0; i < joursSemaine.length; i++) {
        var th = document.createElement('th');
        th.textContent = joursSemaine[i];
        tr.appendChild(th);
    }

    thead.appendChild(tr);
    table.appendChild(thead);

    // Création du corps du calendrier avec des données de démonstration
    var tbody = document.createElement('tbody');

    for (var semaine = 0; semaine < 6; semaine++) {
        var tr = document.createElement('tr');

        for (var jour = 0; jour < 7; jour++) {
            var td = document.createElement('td');
            td.textContent = semaine * 7 + jour + 1;
            tr.appendChild(td);
        }

        tbody.appendChild(tr);
    }

    table.appendChild(tbody);
    calendrier.appendChild(table);

    // Ajout du calendrier à l'élément parent
    element.parentNode.appendChild(calendrier);

    return calendrier;
}

// Fonction pour mettre à jour la plage de dates sélectionnée
function mettreAJourPlageDates() {
    // Réinitialisation de la couleur de fond des jours du calendrier
    var jours = document.querySelectorAll('.calendrier td');
    jours.forEach(function (jour) {
        jour.style.background = 'white';
    });

    // Vérification des dates sélectionnées
    if (dateArrivee && dateDepart) {
        var joursSelectionnes = document.querySelectorAll('.calendrier td');

        // Parcours des jours pour déterminer la plage de dates entre la date d'arrivée et la date de départ
        joursSelectionnes.forEach(function (jour) {
            var dateJour = parseInt(jour.textContent);

            if (dateJour >= dateArrivee && dateJour <= dateDepart) {
                jour.style.background = 'blue';
                jour.style.color = 'white';
            }
        });
    }
}

// Fonction pour sélectionner une date dans le calendrier
function selectionnerDate(calendrier, input, autreCalendrier) {
    var jours = calendrier.querySelectorAll('td');

    jours.forEach(function (jour) {
        jour.addEventListener('click', function () {
            var dateSelectionnee = parseInt(jour.textContent);
            input.value = dateSelectionnee;

            // Mise à jour de la plage de dates sélectionnée
            dateArrivee = parseInt(dateArriveeInput.value);
            dateDepart = parseInt(dateDepartInput.value);
            mettreAJourPlageDates();

            // Affichage/masquage de l'autre calendrier
            toggleCalendrier(autreCalendrier);
        });
    });
}

// Fonction pour afficher ou masquer le calendrier
function toggleCalendrier(calendrier) {
    calendrier.style.display = calendrier.style.display === 'block' ? 'none' : 'block';
}

// Variables pour stocker les dates sélectionnées
var dateArrivee = null;
var dateDepart = null;

// Récupération des éléments du DOM
var dateArriveeInput = document.getElementById('dateArrivee');
var dateDepartInput = document.getElementById('dateDepart');

// Création des calendriers
var calendrierArrivee = creerCalendrier(dateArriveeInput);
var calendrierDepart = creerCalendrier(dateDepartInput);

// Affichage des deux calendriers en même temps
calendrierArrivee.style.display = 'block';
calendrierDepart.style.display = 'block';

// Ajout des événements pour afficher/masquer les calendriers
dateArriveeInput.addEventListener('click', function () {
    toggleCalendrier(calendrierArrivee);
    calendrierDepart.style.display = 'none';
});

dateDepartInput.addEventListener('click', function () {
    toggleCalendrier(calendrierDepart);
    calendrierArrivee.style.display = 'none';
});

// Ajout des événements pour sélectionner les dates
selectionnerDate(calendrierArrivee, dateArriveeInput, calendrierDepart);
selectionnerDate(calendrierDepart, dateDepartInput, calendrierArrivee);

