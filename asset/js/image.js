// document.addEventListener('DOMContentLoaded', function () {

//     function handleCoverSelection(event) {
//         const previousCover = document.querySelector('.cover-selected');
//         if (previousCover) {
//             previousCover.classList.remove('cover-selected');
//         }

//         const coverIndicator = event.currentTarget.querySelector('.cover-indicator');
//         coverIndicator.classList.add('cover-selected');
//     }

//     function image() {
//         // Obtenez tous les éléments avec la classe "picture-rental"
//         let pictureRentals = document.querySelectorAll('.picture-rental:not(.initialized)');

//         // Parcourez chaque élément
//         pictureRentals.forEach(function (pictureRental) {
//             const profileUpload = pictureRental.querySelector('.profile-upload-rental');
//             const profilePicture = pictureRental.querySelector('.profile-picture');

//             // Mettre à jour l'image de profil lors du changement de fichier
//             function updatePicture(event) {
//                 const file = event.target.files[0];
//                 const reader = new FileReader();

//                 reader.onload = function () {
//                     profilePicture.style.backgroundImage = `url(${reader.result})`;
//                 };

//                 if (file) {
//                     reader.readAsDataURL(file);
//                 }
//             }

//             // Attachez les écouteurs d'événements
//             profileUpload.addEventListener('change', updatePicture);
//             profilePicture.addEventListener('click', function () {
//                 profileUpload.click();
//             });

//             // Marquez cet élément comme initialisé
//             pictureRental.classList.add('initialized');

//             // Ajoutez l'écouteur d'événement ici, à l'intérieur de la boucle
//             pictureRental.addEventListener('click', handleCoverSelection);
//         });
//     }
//     image();

//     let btnAddImage = document.querySelectorAll('.addmore-picture');
//     let addImgContainers = document.querySelectorAll('.add-img');

//     btnAddImage.forEach(element => {
//         let clickCount = 0; // Compteur de clics pour ce bouton
//         let onClick = function () {
//             if (clickCount >= 4) {
//                 // Supprimer l'écouteur d'événement après 4 clics
//                 element.removeEventListener('click', onClick);
//                 return;
//             }

//             let htmlContent = '<div class="img-profil-rental"><div class="container-picture"><div class="picture-rental"><input type="file" name="title" class="profile-upload-rental" accept="image/*" style="display: none;"><label for="profile-upload-rental"  class="profile-picture" style="background-image: url(\'{{ asset("/media/images/" ) }}\')"></label></div></div></div>';

//             // Convertissez la chaîne en un élément DOM
//             let div = document.createElement('div');
//             div.innerHTML = htmlContent;
//             let content = div.firstChild;

//             // Ajoutez le contenu à chaque élément avec la classe '.add-img'
//             addImgContainers.forEach(container => {
//                 container.append(content.cloneNode(true));
//             });

//             clickCount++;

//             // Appelez la fonction image() pour initialiser les nouveaux éléments
//             image();
//         };

//         element.addEventListener('click', onClick);
//     });

// });
