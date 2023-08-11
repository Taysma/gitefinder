let hasClickedInputAddress = false;
let addPropety = document.querySelector('.addproperty');
let containerForm = document.getElementsByClassName('form-cart')[0];
let iconHome = document.getElementsByClassName('iconhome')[0];
let cartMaps = document.getElementsByClassName('cart')[0];
let containerEdit = document.getElementsByClassName('editproperty')[0];
let btnEdit = document.querySelectorAll('.edit-btn');
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

let addressInputs = document.querySelectorAll('.address');

addressInputs.forEach((addressInput, index) => {
    let timeout = null;
    let suggestionBox = addressInput.nextElementSibling;
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
        cartMaps.style.visibility = "visible";
        hasClickedInputAddress = true;

        adjustHeight();
    });
});

iconHome.addEventListener('click', function () {
    containerForm.style.visibility = "visible";
    addPropety.style.overflow = "initial";
    iconHome.style.display = "none";
    containerCard.style.display = "none";

});

btnEdit.forEach((button) => {
    button.addEventListener('click', function () {
        containerEdit.style.visibility = "visible";
        containerCard.style.display = "none";
        iconHome.style.display = "none";
        addPropety.style.overflow = "inherit";
    });
});

let cardMaps2 = document.getElementsByClassName('cart')[1];
function adjustHeight() {

    addressInputs.forEach(function (label) {
        cartMaps.style.position = "inherit";
        cardMaps2.style.position = "inherit";

        // if (window.innerWidth <= 768) {
        //     label.style.height = "100px";
        // } else {
        //     label.style.height = "fit-content";
        // }
    });
}

window.addEventListener('resize', function () {
    if (hasClickedInputAddress) {
        adjustHeight();
    }
});
let btnCloseForm = document.querySelectorAll('.close-changes-btn');

btnCloseForm.forEach((button) => {
    button.addEventListener('click', function () {
        containerEdit.style.visibility = "hidden";
        containerEdit.style.position = "absolute";
        containerForm.style.visibility = "hidden";
        containerForm.style.position = "absolute";
        addPropety.style.overflow = "";
        containerCard.style.display = 'grid';
        iconHome.style.display = "initial";
        console.log('coucouc');
    })
});


// ajout image 
function image() {
    // Obtenez tous les éléments avec la classe "picture-rental"
    let pictureRentals = document.querySelectorAll('.picture-rental:not(.initialized)');

    // Parcourez chaque élément
    pictureRentals.forEach(function (pictureRental) {
        const profileUpload = pictureRental.querySelector('.profile-upload-rental');
        const profilePicture = pictureRental.querySelector('.profile-picture');

        // Mettre à jour l'image de profil lors du changement de fichier
        function updatePicture(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                profilePicture.style.backgroundImage = `url(${reader.result})`;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Attachez les écouteurs d'événements
        profileUpload.addEventListener('change', updatePicture);
        profilePicture.addEventListener('click', function () {
            profileUpload.click();
        });

        // Marquez cet élément comme initialisé
        pictureRental.classList.add('initialized');
    });
}
image();

let btnAddImage = document.querySelectorAll('.addmore-picture');
let addImgContainers = document.querySelectorAll('.add-img');

btnAddImage.forEach(element => {
    let clickCount = 0; // Compteur de clics pour ce bouton
    let onClick = function () {
        if (clickCount >= 4) {
            // Supprimer l'écouteur d'événement après 4 clics
            element.removeEventListener('click', onClick);
            return;
        }

        let htmlContent = '<div class="img-profil-rental"><div class="container-picture"><div class="picture-rental"><input type="file" name="title" class="profile-upload-rental" accept="image/*" style="display: none;"><label for="profile-upload-rental"  class="profile-picture" style="background-image: url(\'{{ asset("/media/images/" ) }}\')"></label><input class="btn-edit" type="submit" value="Envoyer"></div></div></div>';

        // Convertissez la chaîne en un élément DOM
        let div = document.createElement('div');
        div.innerHTML = htmlContent;
        let content = div.firstChild;

        // Ajoutez le contenu à chaque élément avec la classe '.add-img'
        addImgContainers.forEach(container => {
            container.append(content.cloneNode(true));
        });

        clickCount++;

        // Appelez la fonction image() pour initialiser les nouveaux éléments
        image();
    };

    element.addEventListener('click', onClick);
});