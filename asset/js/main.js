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
let btnBurger = document.getElementsByClassName('img-burger')[0];
let menuModal = document.getElementById('burger-menu-modal');

btnBurger.addEventListener('click', function () {
    menuModal.style.display = 'block';
});


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


