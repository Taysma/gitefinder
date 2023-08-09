// var map = L.map('mapid').setView([51.505, -0.09], 13); // Position de départ
// var marker;
// var chosenLocations = [];  // Tableau pour stocker les coordonnées choisies

// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 19,
// }).addTo(map);

// var timeout = null;

// // Fonction pour cacher la boîte de suggestions
// function hideSuggestionBox() {
//     $('#autocomplete-items').css('display', 'none');
// }

// // Fonction pour imprimer les coordonnées sans les virgules et les guillemets
// function printCoordinates() {
//     const latitudes = chosenLocations.map(location => location[0]);
//     const longitudes = chosenLocations.map(location => location[1]);

//     $('#latitude').val(latitudes);
//     $('#longitude').val(longitudes);
// }

// // Écoute les événements 'input' sur le champ d'adresse
// $('#address').on('input', function () {
//     var address = $(this).val();
//     var suggestionBox = $('#autocomplete-items');

//     // Annule la précédente requête d'autocomplétion si elle n'est pas encore terminée
//     clearTimeout(timeout);

//     // Si l'input est vide, cache la boîte de suggestions et vide le tableau chosenLocations
//     if (address === '') {
//         suggestionBox.css('display', 'none');
//         chosenLocations = [];
//         $('#latitude').val('');
//         $('#longitude').val('');
//     } else {
//         // Sinon, affiche la boîte de suggestions
//         suggestionBox.css('display', 'block');

//         // Commence une nouvelle requête d'autocomplétion après un délai
//         timeout = setTimeout(function () {
//             fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address))
//                 .then(function (response) {
//                     if (!response.ok) {
//                         throw new Error("Erreur de géocodage");
//                     }
//                     return response.json();
//                 })
//                 .then(function (data) {
//                     // Affiche les suggestions d'adresse
//                     var suggestions = data.map(function (item) {
//                         return {
//                             name: item.display_name,
//                             lat: item.lat,
//                             lon: item.lon
//                         };
//                     });

//                     suggestionBox.empty();  // Nettoie les anciennes suggestions

//                     // Crée un élément pour chaque suggestion
//                     for (var i = 0; i < suggestions.length; i++) {
//                         var item = $("<div class='data'></div>").text(suggestions[i].name);
//                         item.click((function (i) {
//                             return function () {
//                                 $('#address').val(suggestions[i].name);  // Met à jour le champ d'adresse
//                                 hideSuggestionBox(); // Appelle la fonction pour cacher la boîte de suggestions
//                                 map.setView([suggestions[i].lat, suggestions[i].lon], 13);  // Met à jour la carte

//                                 // Si un marqueur existait déjà, le supprime
//                                 if (marker) {
//                                     map.removeLayer(marker);
//                                 }

//                                 // Réinitialise le tableau chosenLocations avant d'ajouter le nouveau choix
//                                 chosenLocations = [];

//                                 // Ajoute un nouveau marqueur
//                                 marker = L.marker([suggestions[i].lat, suggestions[i].lon]).addTo(map);

//                                 // Ajoute la location au tableau
//                                 chosenLocations.push([suggestions[i].lat, suggestions[i].lon]);

//                                 // Imprime le dernier choix (tableau avec un seul élément) dans la console
//                                 console.log(chosenLocations);

//                                 // Appelle la fonction pour imprimer les coordonnées sans les virgules et les guillemets
//                                 printCoordinates();
//                             };
//                         })(i));
//                         suggestionBox.append(item);
//                     }
//                 })
//                 .catch(function (error) {
//                     alert("Une erreur est survenue lors du géocodage : " + error);
//                 });
//         }, 200);  // Durée du délai en millisecondes
//     }
// });



// document.addEventListener('DOMContentLoaded', function () {
//     var myIcon = L.icon({
//         iconUrl: "../asset/media/icon/home.svg",
//         iconSize: [38, 95],

//     });

//     var map = L.map('mapid').setView([51.505, -0.09], 17);
//     var marker;

//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         maxZoom: 19,
//     }).addTo(map);

//     var timeout = null;

//     function hideSuggestionBox() {
//         $('#autocomplete-items').css('display', 'none');
//     }

//     function printCoordinates(lat, lon) {
//         $('#latitude').val(lat);
//         $('#longitude').val(lon);
//     }

//     $('#address').on('input', function () {
//         var address = $(this).val();
//         var suggestionBox = $('#autocomplete-items');

//         clearTimeout(timeout);

//         if (address === '') {
//             suggestionBox.css('display', 'none');
//             $('#latitude').val('');
//             $('#longitude').val('');
//         } else {
//             suggestionBox.css('display', 'block');

//             timeout = setTimeout(function () {
//                 fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address))
//                     .then(function (response) {
//                         if (!response.ok) {
//                             throw new Error("Erreur de géocodage");
//                         }
//                         return response.json();
//                     })
//                     .then(function (data) {
//                         var suggestions = data.map(function (item) {
//                             return {
//                                 name: item.display_name,
//                                 lat: item.lat,
//                                 lon: item.lon
//                             };
//                         });

//                         suggestionBox.empty();

//                         for (var i = 0; i < suggestions.length; i++) {
//                             var item = $("<div class='data'></div>").text(suggestions[i].name);
//                             item.click((function (i) {
//                                 return function () {
//                                     $('#address').val(suggestions[i].name);
//                                     hideSuggestionBox();
//                                     map.setView([suggestions[i].lat, suggestions[i].lon], 13);

//                                     if (marker) {
//                                         map.removeLayer(marker);
//                                     }

//                                     marker = L.marker([suggestions[i].lat, suggestions[i].lon], { icon: myIcon }).addTo(map);

//                                     printCoordinates(suggestions[i].lat, suggestions[i].lon);

//                                     var data = {
//                                         latitude: suggestions[i].lat,
//                                         longitude: suggestions[i].lon
//                                     };

//                                     fetch('addProperty', {
//                                         method: 'POST',
//                                         headers: {
//                                             'Content-Type': 'application/json',
//                                         },
//                                         body: JSON.stringify(data),
//                                     })
//                                         .then(response => response.json())
//                                         .then(data => {
//                                             console.log('Success:', data);
//                                         })
//                                         .catch((error) => {
//                                             console.error('Error:', error);
//                                         });
//                                 };
//                             })(i));
//                             suggestionBox.append(item);
//                         }
//                     })
//                     .catch(function (error) {
//                         alert("Une erreur est survenue lors du géocodage : " + error);
//                     });
//             }, 200);
//         }
//     });
// });


// let addPropety = document.querySelector('.addproperty');
// let containerForm = document.getElementsByClassName('form-cart')[0];
// let iconHome = document.querySelector('.iconhome');
// let inputAddress = document.getElementById('address');
// let cartMaps = document.getElementsByClassName('cart')[0];
// let containerCard = document.getElementsByClassName('container-card-property')[0];
// var myIcon = L.icon({
//     iconUrl: "../asset/media/icon/home.svg",
//     iconSize: [38, 95],
// });

// var map = L.map('mapid').setView([51.505, -0.09], 17);
// var marker;

// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 29,
// }).addTo(map);

// var timeout = null;
// var addressInput = document.querySelectorAll('.address');
// var suggestionBox = document.querySelectorAll('.autocomplete-items');

// function hideSuggestionBox() {
//     suggestionBox.style.display = 'none';
// }

// function printCoordinates(lat, lon) {
//     document.getElementById('latitude').value = lat;
//     document.getElementById('longitude').value = lon;
// }

// addressInput.addEventListener('input', function () {
//     var address = this.value;

//     clearTimeout(timeout);

//     if (address === '') {
//         suggestionBox.style.display = 'none';
//         document.getElementById('latitude').value = '';
//         document.getElementById('longitude').value = '';
//     } else {
//         suggestionBox.style.display = 'block';

//         timeout = setTimeout(function () {
//             fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address))
//                 .then(function (response) {
//                     if (!response.ok) {
//                         throw new Error("Erreur de géocodage");
//                     }
//                     return response.json();
//                 })
//                 .then(function (data) {
//                     var suggestions = data.map(function (item) {
//                         return {
//                             name: item.display_name,
//                             lat: item.lat,
//                             lon: item.lon
//                         };
//                     });

//                     suggestionBox.innerHTML = '';

//                     for (var i = 0; i < suggestions.length; i++) {
//                         var item = document.createElement('div');
//                         item.classList.add('data');
//                         item.textContent = suggestions[i].name;

//                         item.addEventListener('click', (function (i) {
//                             return function () {
//                                 addressInput.value = suggestions[i].name;
//                                 hideSuggestionBox();
//                                 map.setView([suggestions[i].lat, suggestions[i].lon], 18);

//                                 if (marker) {
//                                     map.removeLayer(marker);
//                                 }

//                                 marker = L.marker([suggestions[i].lat, suggestions[i].lon], { icon: myIcon }).addTo(map);

//                                 printCoordinates(suggestions[i].lat, suggestions[i].lon);
//                             };
//                         })(i));

//                         suggestionBox.appendChild(item);
//                     }
//                 })
//                 .catch(function (error) {
//                     alert("Une erreur est survenue lors du géocodage : " + error);
//                 });
//         }, 200);
//     }
// });






// addPropety.addEventListener('click', function () {
//     containerForm.style.visibility = "visible";
//     iconHome.style.display = "none";
//     containerCard.style.display = "none";

// });

// inputAddress.addEventListener('click', function () {
//     cartMaps.style.visibility = "visible";
// });

let addPropety = document.querySelector('.addproperty');
let containerForm = document.getElementsByClassName('form-cart')[0];
let iconHome = document.getElementsByClassName('iconhome')[0];
let inputAddress = document.getElementById('address');
let cartMaps = document.getElementsByClassName('cart')[0];
let containerEdit = document.getElementsByClassName('editproperty')[0];
let btnEdit = document.getElementsByClassName('edit-btn')[0];
let containerCard = document.getElementsByClassName('container-card-property')[0];
var myIcon = L.icon({
    iconUrl: "../asset/media/icon/home.svg",
    iconSize: [38, 95],
});
var map = L.map('mapid').setView([51.505, -0.09], 17);
var marker;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 29,
}).addTo(map);

var addressInputs = document.querySelectorAll('.address');

addressInputs.forEach((addressInput, index) => {
    let timeout = null;
    let suggestionBox = addressInput.nextElementSibling; // Supposons que la boîte de suggestion soit juste après l'input

    function hideSuggestionBox() {
        suggestionBox.style.display = 'none';
    }

    function printCoordinates(lat, lon) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;
    }

    addressInput.addEventListener('input', function () {
        var address = this.value;

        clearTimeout(timeout);

        if (address === '') {
            hideSuggestionBox();
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        } else {
            suggestionBox.style.display = 'block';

            timeout = setTimeout(function () {
                fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(address))
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Erreur de géocodage");
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        var suggestions = data.map(function (item) {
                            return {
                                name: item.display_name,
                                lat: item.lat,
                                lon: item.lon
                            };
                        });

                        suggestionBox.innerHTML = '';

                        for (var i = 0; i < suggestions.length; i++) {
                            var item = document.createElement('div');
                            item.classList.add('data');
                            item.textContent = suggestions[i].name;

                            item.addEventListener('click', (function (i) {
                                return function () {
                                    addressInput.value = suggestions[i].name;
                                    hideSuggestionBox();
                                    map.setView([suggestions[i].lat, suggestions[i].lon], 18);

                                    if (marker) {
                                        map.removeLayer(marker);
                                    }

                                    marker = L.marker([suggestions[i].lat, suggestions[i].lon], { icon: myIcon }).addTo(map);

                                    printCoordinates(suggestions[i].lat, suggestions[i].lon);
                                };
                            })(i));

                            suggestionBox.appendChild(item);
                        }
                    })
                    .catch(function (error) {
                        alert("Une erreur est survenue lors du géocodage : " + error);
                    });
            }, 200);
        }
    });
    addressInput.addEventListener('click', function () {
        cartMaps.style.visibility = "visible"; // Affiche la carte
    });
});

iconHome.addEventListener('click', function () {
    containerForm.style.visibility = "visible";
    iconHome.style.display = "none";
    containerCard.style.display = "none";
    addPropety.style.overflow = "initial";

});






btnEdit.addEventListener('click', function () {
    containerEdit.style.visibility = "visible";
    containerCard.style.display = "none";
    iconHome.style.display = "none";
    addPropety.style.overflow = "initial";


});
inputAddress.addEventListener('click', function () {
    cartMaps.style.visibility = "visible";

});