document.addEventListener('DOMContentLoaded', function () {
    var mapElement = document.getElementById('mapid');
    var latitude = mapElement.dataset.latitude;
    var longitude = mapElement.dataset.longitude;

    var map = L.map('mapid').setView([latitude, longitude], 17);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 19,
    }).addTo(map);

    var myIcon = L.icon({
        iconUrl: "../asset/media/icon/home.svg",
        iconSize: [38, 95],      // Taille de l'icône
        // iconAnchor: [22, 94],    // Point de l'icône qui correspondra à la position du marqueur
        // popupAnchor: [-3, -76],  // Point à partir duquel le popup s'ouvrira, par rapport à l'iconAnchor
    });

    L.marker([latitude, longitude], { icon: myIcon }).addTo(map);
});