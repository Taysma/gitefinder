// document.addEventListener('DOMContentLoaded', function () {
//     var mapElement = document.getElementById('mapid');
//     var latitude = mapElement.dataset.latitude;
//     var longitude = mapElement.dataset.longitude;

//     var map = L.map('mapid').setView([latitude, longitude], 17);
//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
//         maxZoom: 19,
//     }).addTo(map);

//     var myIcon = L.icon({
//         iconUrl: "../asset/media/icon/home.svg",
//         iconSize: [38, 95],      // Taille de l'icône
//         // iconAnchor: [22, 94],    // Point de l'icône qui correspondra à la position du marqueur
//         // popupAnchor: [-3, -76],  // Point à partir duquel le popup s'ouvrira, par rapport à l'iconAnchor
//     });

//     L.marker([latitude, longitude], { icon: myIcon }).addTo(map);
// });

// // document.addEventListener('DOMContentLoaded', function () {
// //     let inputSearchElements = document.querySelectorAll('.name'); // J'ai changé l'ID en classe
// //     let h1Elements = document.querySelectorAll('.h1-complete');  // J'ai également changé l'ID en classe

// //     inputSearchElements.forEach((inputSearch, index) => {
// //         let originalH1Content = h1Elements[index].innerHTML;

// //         inputSearch.addEventListener('input', function () {
// //             if (inputSearch.value.length > 2) {
// //                 // Ajoutez la valeur de l'input à la suite du contenu original de h1
// //                 h1Elements[index].innerHTML = originalH1Content + inputSearch.value;
// //             } else {
// //                 // Réinitialisez à la valeur originale si la longueur du texte est inférieure à 3
// //                 h1Elements[index].innerHTML = originalH1Content;
// //             }
// //         });
// //     });
// // });



// // document.addEventListener('DOMContentLoaded', function () {
// //     let inputNames = document.querySelectorAll('.name');
// //     let h1Elements = document.querySelectorAll('.h1-complete-edit');

// //     inputNames.forEach((inputName) => {
// //         inputName.addEventListener('input', function () {
// //             h1Elements.forEach((h1Element) => {
// //                 h1Element.innerHTML = inputName.value;
// //             });
// //         });
// //     });
// // });

// document.addEventListener('DOMContentLoaded', function () {
//     let inputName = document.querySelector('.name input'); // Sélection de l'input avec la classe 'name'
//     let h1Element = document.querySelector('.h1-complete-edit'); // Sélection du h1 avec la classe 'h1-complete-edit'

//     inputName.addEventListener('input', function () {
//         h1Element.innerHTML = inputName.value;
//     });
// });




document.addEventListener('DOMContentLoaded', function () {
    initMap();
    handleNameInputChange();
});

function initMap() {
    const mapElement = document.getElementById('mapid');
    let map;

    if (mapElement) {
        const latitude = mapElement.dataset.latitude;
        const longitude = mapElement.dataset.longitude;

        if (!window.mapInstance) {
            map = L.map('mapid').setView([latitude, longitude], 17);
            window.mapInstance = map;  // Store the map instance globally
        } else {
            map = window.mapInstance;
        }

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(map);

        const myIcon = L.icon({
            iconUrl: "../asset/media/icon/home.svg",
            iconSize: [38, 95]
        });

        L.marker([latitude, longitude], { icon: myIcon }).addTo(map);
    }
}

function handleNameInputChange() {
    const inputName = document.querySelector('.name input');
    const h1Element = document.querySelector('.h1-complete-edit');

    if (inputName && h1Element) {
        inputName.addEventListener('input', function () {
            h1Element.innerHTML = inputName.value;
        });
    }
}
