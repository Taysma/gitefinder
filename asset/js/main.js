document.addEventListener('DOMContentLoaded', function () {
    const buttonSearch = document.querySelector('.button-search');
    const searchBar = document.querySelector('.search-bar-form');
    const menuBurger = document.querySelector('.menu-burger-header');
    let isSearchBarVisible = false;
    let isAboveThreshold = window.innerWidth > 769;

    buttonSearch.addEventListener('click', function (event) {
        event.stopPropagation();
        isSearchBarVisible = !isSearchBarVisible;

        if (isSearchBarVisible) {
            searchBar.style.display = 'flex';
            searchBar.animate(
                [
                    { opacity: 0, transform: 'translateY(-10px)' },
                    { opacity: 1, transform: 'translateY(0)' },
                ],
                {
                    duration: 500,
                    easing: 'ease-out',
                    fill: 'both',
                }
            );
            buttonSearch.innerHTML =
                '<img src="/projets/gitefinder/asset/media/icon/x-solid.svg" alt="">';
            menuBurger.style.display = 'none';
        } else {
            searchBar.animate(
                [
                    { opacity: 1, transform: 'translateY(0)' },
                    { opacity: 0, transform: 'translateY(-10px)' },
                ],
                {
                    duration: 500,
                    easing: 'ease-out',
                    fill: 'both',
                }
            );

            setTimeout(function () {
                searchBar.style.display = 'none';
                buttonSearch.innerHTML =
                    '<img src="/projets/gitefinder/asset/media/icon/magnifying-glass-solid.svg" alt="">';
                menuBurger.style.display = 'block';
            }, 500);
        }
    });

    window.addEventListener('resize', function () {
        const currentWidth = window.innerWidth;
        const isThresholdExceeded = currentWidth == 769;

        if (isThresholdExceeded !== isAboveThreshold) {
            isAboveThreshold = isThresholdExceeded;
            if (isAboveThreshold) {
                location.reload(); // Actualiser la page sans recharger
            }
        }
    });
});



//menu burger
let btnBurger = document.querySelector('.menu-burger-header .img-burger');
let menuModal = document.getElementById('burger-menu-modal');
let menuOpen = false; // Booléen pour garder une trace de l'état du menu

if (btnBurger && menuModal) {
    btnBurger.addEventListener('click', function (event) {
        event.stopPropagation();
        if (menuOpen) {
            menuModal.style.display = 'none';
            menuOpen = false;
        } else {
            menuModal.style.display = 'block';
            menuOpen = true;
        }
    });

    document.addEventListener('click', function () {
        if (menuOpen) {
            menuModal.style.display = 'none';
            menuOpen = false;
        }
    });
}



// slider image post

document.addEventListener('DOMContentLoaded', function () {
    var sliderImages = document.getElementsByClassName('sliderImage');
    var mainImage = document.getElementById('mainImage');

    for (var i = 0; i < sliderImages.length; i++) {
        sliderImages[i].addEventListener('click', function () {
            var tempSrc = mainImage.src;  // Stocker temporairement l'image principale
            mainImage.src = this.src;  // Changer l'image principale
            this.src = tempSrc;  // Changer l'image du slider
        });
    }
});


// image profil

// Utilisez l'événement DOMContentLoaded pour vous assurer que le DOM est chargé avant d'ajouter l'événement
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez l'élément de la photo de profil et l'input de téléchargement de fichier
    const profilePicture = document.getElementById('profile-picture');
    const profileUpload = document.getElementById('profile-upload');

    // Fonction pour mettre à jour l'image de profil
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

    // Ajoutez un événement de changement de fichier à l'input de téléchargement
    profileUpload.addEventListener('change', updatePicture);
});








