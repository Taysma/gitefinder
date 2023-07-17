// Cette fonction initialise la carte.
function initMap() {
    // Nous créons une nouvelle carte Google Maps. Nous la centrons sur une coordonnée par défaut.
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: { lat: -34.397, lng: 150.644 }
    });

    // Nous créons un nouveau géocodeur. Le géocodeur est un service qui permet de convertir une adresse en coordonnées de latitude et de longitude.
    var geocoder = new google.maps.Geocoder();

    // Nous récupérons l'ID du bien à louer depuis quelque part (peut-être intégré dans le HTML ou un attribut de données).
    var rentalId = document.getElementById('map').getAttribute('data-rental-id');

    // Nous faisons une requête AJAX à l'endpoint '/getLocation/' + rentalId pour obtenir les informations de localisation du bien à louer.
    $.getJSON('/getLocation/' + rentalId, function (data) {
        // Une fois que nous avons les informations de localisation, nous les utilisons pour géocoder l'adresse et mettre à jour la carte.
        geocodeAddress(geocoder, map, data.address);
    });
}

// Cette fonction utilise le géocodeur pour convertir une adresse en coordonnées de latitude et de longitude, puis met à jour la carte pour se centrer sur ces coordonnées.
function geocodeAddress(geocoder, resultsMap, address) {
    geocoder.geocode({ 'address': address }, function (results, status) {
        // Si le géocodage a réussi, nous mettons à jour la carte.
        if (status === 'OK') {
            // Nous centrons la carte sur la position géocodée.
            resultsMap.setCenter(results[0].geometry.location);
            // Nous créons un nouveau marqueur sur la carte à la position géocodée.
            new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            // Si le géocodage a échoué, nous affichons une alerte avec le statut de l'erreur.
            alert('Le géocodage n\'a pas réussi pour la raison suivante: ' + status);
        }
    });
}
