$(function () {
    var map = L.map('mapid').setView([51.505, -0.09], 13); // Position de départ
    var marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var timeout = null;

    // Écoute les événements 'input' sur le champ d'adresse
    $('#address').on('input', function () {
        var address = $(this).val();
        var suggestionBox = $('#autocomplete-items');

        // Annule la précédente requête d'autocomplétion si elle n'est pas encore terminée
        clearTimeout(timeout);

        // Si l'input est vide, cache la boîte de suggestions
        if (address === '') {
            suggestionBox.css('display', 'none');
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
                            var item = $('<div></div>').text(suggestions[i].name);
                            item.click((function (i) {
                                return function () {
                                    $('#address').val(suggestions[i].name);  // Met à jour le champ d'adresse
                                    suggestionBox.empty();  // Nettoie les suggestions
                                    map.setView([suggestions[i].lat, suggestions[i].lon], 13);  // Met à jour la carte

                                    // Si un marqueur existait déjà, le supprime
                                    if (marker) {
                                        map.removeLayer(marker);
                                    }

                                    // Ajoute un nouveau marqueur
                                    marker = L.marker([suggestions[i].lat, suggestions[i].lon]).addTo(map);
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
});
