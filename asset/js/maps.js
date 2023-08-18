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


// // ajout image + ajout dans le container
// function image() {
//     // Obtenez tous les éléments avec la classe "picture-rental"
//     let pictureRentals = document.querySelectorAll('.picture-rental:not(.initialized)');

//     // Parcourez chaque élément
//     pictureRentals.forEach(function (pictureRental) {
//         const profileUpload = pictureRental.querySelector('.profile-upload-rental');
//         const profilePicture = pictureRental.querySelector('.profile-picture');

//         // Mettre à jour l'image de profil lors du changement de fichier
//         function updatePicture(event) {
//             const file = event.target.files[0];
//             const reader = new FileReader();

//             reader.onload = function () {
//                 profilePicture.style.backgroundImage = `url(${reader.result})`;
//             };

//             if (file) {
//                 reader.readAsDataURL(file);
//             }
//         }

//         // Attachez les écouteurs d'événements
//         profileUpload.addEventListener('change', updatePicture);
//         profilePicture.addEventListener('click', function () {
//             profileUpload.click();
//         });

//         // Marquez cet élément comme initialisé
//         pictureRental.classList.add('initialized');
//     });
// }
// image();

// let btnAddImage = document.querySelectorAll('.addmore-picture');
// let addImgContainers = document.querySelectorAll('.add-img');

// btnAddImage.forEach(element => {
//     let clickCount = 0; // Compteur de clics pour ce bouton
//     let onClick = function () {
//         if (clickCount >= 4) {
//             // Supprimer l'écouteur d'événement après 4 clics
//             element.removeEventListener('click', onClick);
//             return;
//         }

//         let htmlContent = '<div class="img-profil-rental"><div class="container-picture"><div class="picture-rental"><input type="file" name="title[]" class="profile-upload-rental" accept="image/*" style="display: none;"><label for="profile-upload-rental"  class="profile-picture" style="background-image: url(\'{{ asset("/media/images/" ) }}\')"></label></div></div></div>';

//         // Convertissez la chaîne en un élément DOM
//         let div = document.createElement('div');
//         div.innerHTML = htmlContent;
//         let content = div.firstChild;

//         // Ajoutez le contenu à chaque élément avec la classe '.add-img'
//         addImgContainers.forEach(container => {
//             container.append(content.cloneNode(true));
//         });

//         clickCount++;

//         // Appelez la fonction image() pour initialiser les nouveaux éléments
//         image();
//     };

//     element.addEventListener('click', onClick);
// });



// document.addEventListener("DOMContentLoaded", function () {

//     const profileUploads = document.querySelectorAll('.profile-upload-rental[name="cover"]');
//     const profilePictures = document.querySelectorAll('.profile-picture.firstImage');
//     const imgDisplays = document.querySelectorAll('.img-card.imageContainer img');

//     // Mettre à jour l'image de profil lors du changement de fichier
//     function updatePicture(event, profilePicture, imgDisplay) {
//         const file = event.target.files[0];
//         const reader = new FileReader();

//         reader.onload = function () {
//             const imageUrl = reader.result;
//             profilePicture.style.backgroundImage = `url(${imageUrl})`;
//             imgDisplay.src = imageUrl; // Mettre à jour la source de l'image
//         };

//         if (file) {
//             reader.readAsDataURL(file);
//         }
//     }

//     // Attachez les écouteurs d'événements pour chaque groupe d'éléments
//     profileUploads.forEach((uploadElem, index) => {
//         uploadElem.addEventListener('change', function (event) {
//             updatePicture(event, profilePictures[index], imgDisplays[index]);
//         });
//         profilePictures[index].addEventListener('click', function () {
//             uploadElem.click();
//         });
//     });
// });


// document.addEventListener("DOMContentLoaded", function () {
//     const profileUpload = document.querySelector('.profile-upload-rental[name="cover"]');
//     const profilePicture = document.querySelector('.profile-picture.firstImage');
//     const imgDisplay = document.querySelector('.img-card.imageContainer img'); // Récupère l'image déjà présente

//     // Mettre à jour l'image de profil lors du changement de fichier
//     function updatePicture(event) {
//         const file = event.target.files[0];
//         const reader = new FileReader();

//         reader.onload = function () {
//             const imageUrl = reader.result;
//             profilePicture.style.backgroundImage = `url(${imageUrl})`;
//             imgDisplay.src = imageUrl; // Mettre à jour la source de l'image
//         };

//         if (file) {
//             reader.readAsDataURL(file);
//         }
//     }

//     // Attachez les écouteurs d'événements
//     profileUpload.addEventListener('change', updatePicture);
//     profilePicture.addEventListener('click', function () {
//         profileUpload.click();
//     });
// });




// function attachListeners(profileUpload, profilePicture, imgDisplay) {
//     function updatePicture(event) {
//         const file = event.target.files[0];
//         const reader = new FileReader();

//         reader.onload = function () {
//             profilePicture.style.backgroundImage = `url(${reader.result})`;
//             if (imgDisplay) {
//                 imgDisplay.src = reader.result;
//             }
//         };

//         if (file) {
//             reader.readAsDataURL(file);
//         }
//     }

//     profileUpload.addEventListener('change', updatePicture);
//     profilePicture.addEventListener('click', function () {
//         profileUpload.click();
//     });
// }

// // ajout image + ajout dans le container
// function image() {
//     let pictureRentals = document.querySelectorAll('.picture-rental:not(.initialized)');

//     pictureRentals.forEach(pictureRental => {
//         const profileUpload = pictureRental.querySelector('.profile-upload-rental');
//         const profilePicture = pictureRental.querySelector('.profile-picture');

//         attachListeners(profileUpload, profilePicture);

//         pictureRental.classList.add('initialized');
//     });
// }

// image();

// let btnAddImage = document.querySelectorAll('.addmore-picture');
// let addImgContainers = document.querySelectorAll('.add-img');

// btnAddImage.forEach(element => {
//     let clickCount = 0;
//     let onClick = function () {
//         if (clickCount >= 4) {
//             element.removeEventListener('click', onClick);
//             return;
//         }

//         let htmlContent = '<div class="img-profil-rental"><div class="container-picture">' +
//             '<form action="" method="POST">' + '<button type="button" class="btn-delete-picture">' +
//             '<svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">' +
//             '<path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>' +
//             '</svg></button>' +
//             '<div class="picture-rental">' +
//             '<input type="file" name="title[]" class="profile-upload-rental" accept="image/*" style="display: none;">' +
//             '<label for="profile-upload-rental" class="profile-picture" style="background-image: url(\'{{ asset("/media/images/") }}\')"></label>' +
//             '</div>' +

//             '</form>' +
//             '</div></div>';

//         let div = document.createElement('div');
//         div.innerHTML = htmlContent;
//         let content = div.firstChild;

//         addImgContainers.forEach(container => {
//             container.append(content.cloneNode(true));
//         });

//         clickCount++;

//         image();
//     };

//     element.addEventListener('click', onClick);
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const profileUploads = document.querySelectorAll('.profile-upload-rental[name="cover"]');
//     const profilePictures = document.querySelectorAll('.profile-picture.firstImage');
//     const imgDisplays = document.querySelectorAll('.img-card.imageContainer img');

//     profileUploads.forEach((uploadElem, index) => {
//         attachListeners(uploadElem, profilePictures[index], imgDisplays[index]);
//     });
// });



function attachListeners(profileUpload, profilePicture, imgDisplay) {
    function updatePicture(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function () {
            profilePicture.style.backgroundImage = `url(${reader.result})`;
            if (imgDisplay) {
                imgDisplay.src = reader.result;
            }
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function triggerProfileUpload() {
        profileUpload.click();
    }

    // Remove existing listeners to prevent duplication
    profileUpload.removeEventListener('change', updatePicture);
    profilePicture.removeEventListener('click', triggerProfileUpload);

    // Add the listeners
    profileUpload.addEventListener('change', updatePicture);
    profilePicture.addEventListener('click', triggerProfileUpload);
}

function image() {
    let pictureRentals = document.querySelectorAll('.picture-rental:not(.initialized)');

    pictureRentals.forEach(pictureRental => {
        const profileUpload = pictureRental.querySelector('.profile-upload-rental');
        const profilePicture = pictureRental.querySelector('.profile-picture');

        attachListeners(profileUpload, profilePicture);

        pictureRental.classList.add('initialized');
    });
}

function attachDeleteListeners() {
    const deleteButtons = document.querySelectorAll('.btn-delete-picture');
    deleteButtons.forEach(button => {
        button.removeEventListener('click', handleDeleteClick);
        button.addEventListener('click', handleDeleteClick);
    });
}

function handleDeleteClick(event) {
    const divToRemove = event.currentTarget.closest('.img-profil-rental');
    if (divToRemove) {
        divToRemove.remove();
        if (clickCount > 0) clickCount--;
        attachDeleteListeners();
    }
}

image();

let btnAddImage = document.querySelectorAll('.addmore-picture');
let addImgContainers = document.querySelectorAll('.add-img');
let clickCount = 0;

btnAddImage.forEach(element => {
    let onClick = function () {
        if (clickCount >= 4) {
            return;
        }

        let htmlContent = '<div class="img-profil-rental"><div class="container-picture">' +
            '<form action="" method="POST">' + '<button type="button" class="btn-delete-picture">' +
            '<svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">' +
            '<path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>' +
            '</svg></button>' +
            '<div class="picture-rental">' +
            '<input type="file" name="title[]" class="profile-upload-rental" accept="image/*" style="display: none;">' +
            '<label for="profile-upload-rental" class="profile-picture" style="background-image: url(\'{{ asset("/media/images/") }}\')"></label>' +
            '</div>' +
            '</form>' +
            '</div></div>';

        let div = document.createElement('div');
        div.innerHTML = htmlContent;
        let content = div.firstChild;

        addImgContainers.forEach(container => {
            container.append(content.cloneNode(true));
        });

        clickCount++;
        image();
        attachDeleteListeners();
    };

    element.addEventListener('click', onClick);
});

document.addEventListener("DOMContentLoaded", function () {
    const profileUploads = document.querySelectorAll('.profile-upload-rental[name="cover"]');
    const profilePictures = document.querySelectorAll('.profile-picture.firstImage');
    const imgDisplays = document.querySelectorAll('.img-card.imageContainer img');

    profileUploads.forEach((uploadElem, index) => {
        attachListeners(uploadElem, profilePictures[index], imgDisplays[index]);
    });

    attachDeleteListeners();
});






// function supprimerItem(id) {
//     // Remplacez cette URL par l'URL de votre route de suppression
//     let url = `${id}`;

//     fetch(url, {
//         method: 'DELETE', // Utilisez la méthode DELETE pour la suppression
//         headers: {
//             'Content-Type': 'application/json',
//             // Ajoutez d'autres en-têtes si nécessaire (par exemple, un token d'authentification)
//         }
//     })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Erreur réseau lors de la tentative de suppression.');
//             }
//             return response.json(); // Ou peut-être `response.text()` si vous ne renvoyez pas de JSON
//         })
//         .then(data => {
//             // Traitez la réponse ici. Par exemple, vous pourriez actualiser l'interface utilisateur
//             // pour refléter la suppression de l'élément.
//             console.log('Item supprimé avec succès:', data);
//         })
//         .catch(error => {
//             console.error('Il y a eu un problème avec la requête de suppression:', error);
//         });
// }

// document.addEventListener('DOMContentLoaded', function() {
//     // Sélectionnez tous les boutons avec la classe "btn-delete-picture"
//     const deleteButtons = document.querySelectorAll('.btn-delete-picture');

//     // Ajoutez un écouteur d'événements à chaque bouton
//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function(event) {
//             const id = event.currentTarget.getAttribute('data-id');
//             if (id) {
//                 supprimerItem(id);

//                 // Supprimez la div avec la classe .img-profil-rental
//                 const divToRemove = event.currentTarget.closest('.img-profil-rental');
//                 if (divToRemove) {
//                     divToRemove.remove();
//                 }
//             } else {
//                 console.error('ID manquant pour le bouton de suppression.');
//             }
//         });
//     });
// });