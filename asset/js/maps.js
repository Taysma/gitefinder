var map = L.map('mapid').setView([51.505, -0.09], 13); // Position de départ
var marker;
var chosenLocations = [];  // Tableau pour stocker les coordonnées choisies

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

var timeout = null;

// Fonction pour cacher la boîte de suggestions
function hideSuggestionBox() {
    $('#autocomplete-items').css('display', 'none');
}

// Fonction pour imprimer les coordonnées sans les virgules et les guillemets
function printCoordinates() {
    const coordinates = chosenLocations.map(location => `${location[0]} ${location[1]}`);
    const formattedCoordinates = JSON.stringify(coordinates).replace(/["']/g, '');
    console.log(formattedCoordinates);
}

// Écoute les événements 'input' sur le champ d'adresse
$('#address').on('input', function () {
    var address = $(this).val();
    var suggestionBox = $('#autocomplete-items');

    // Annule la précédente requête d'autocomplétion si elle n'est pas encore terminée
    clearTimeout(timeout);

    // Si l'input est vide, cache la boîte de suggestions et vide le tableau chosenLocations
    if (address === '') {
        suggestionBox.css('display', 'none');
        chosenLocations = [];
    } else {
        // Sinon, affiche la boîte de suggestions
        suggestionBox.css('display', 'block');

        // Commence une nouvelle requête d'autocomplétion après un délai
        timeout = setTimeout(function () {
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address))
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error("Erreur de géocodage");
                    }
                    return response.json();
                })
                .then(function (data) {
                    // Affiche les suggestions d'adresse
                    var suggestions = data.map(function (item) {
                        return {
                            name: item.display_name,
                            lat: item.lat,
                            lon: item.lon
                        };
                    });

                    suggestionBox.empty();  // Nettoie les anciennes suggestions

                    // Crée un élément pour chaque suggestion
                    for (var i = 0; i < suggestions.length; i++) {
                        var item = $("<div class='data'></div>").text(suggestions[i].name);
                        item.click((function (i) {
                            return function () {
                                $('#address').val(suggestions[i].name);  // Met à jour le champ d'adresse
                                hideSuggestionBox(); // Appelle la fonction pour cacher la boîte de suggestions
                                map.setView([suggestions[i].lat, suggestions[i].lon], 13);  // Met à jour la carte

                                // Si un marqueur existait déjà, le supprime
                                if (marker) {
                                    map.removeLayer(marker);
                                }

                                // Réinitialise le tableau chosenLocations avant d'ajouter le nouveau choix
                                chosenLocations = [];

                                // Ajoute un nouveau marqueur
                                marker = L.marker([suggestions[i].lat, suggestions[i].lon]).addTo(map);

                                // Ajoute la location au tableau
                                chosenLocations.push([suggestions[i].lat, suggestions[i].lon]);

                                // Imprime le dernier choix (tableau avec un seul élément) dans la console
                                console.log(chosenLocations);

                                // Appelle la fonction pour imprimer les coordonnées sans les virgules et les guillemets
                                printCoordinates();
                            };
                        })(i));
                        suggestionBox.append(item);
                    }
                })
                .catch(function (error) {
                    alert("Une erreur est survenue lors du géocodage : " + error);
                });
        }, 200);  // Durée du délai en millisecondes
    }
});