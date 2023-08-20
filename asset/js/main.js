


// document.addEventListener("DOMContentLoaded", function () {
//     let buttonSearch = document.querySelector('.button-search');
//     let searchBar = document.querySelector('.search-bar-form');
//     let menuBurger = document.querySelectorAll('.menu-burger-header');
//     let isSearchBarVisible = false;
//     let isAboveThreshold = window.innerWidth > 769;

//     buttonSearch.addEventListener('click', function (event) {
//         event.stopPropagation();
//         isSearchBarVisible = !isSearchBarVisible;

//         if (isSearchBarVisible) {
//             searchBar.style.display = 'flex';
//             searchBar.animate(
//                 [
//                     { opacity: 0, transform: 'translateY(-10px)' },
//                     { opacity: 1, transform: 'translateY(0)' },
//                 ],
//                 {
//                     duration: 500,
//                     easing: 'ease-out',
//                     fill: 'both',
//                 }
//             );
//             buttonSearch.innerHTML =
//                 '<img src="/projets/gitefinder/asset/media/icon/x-solid.svg" alt="">';
//             menuBurger.style.display = 'none';
//         } else {
//             searchBar.animate(
//                 [
//                     { opacity: 1, transform: 'translateY(0)' },
//                     { opacity: 0, transform: 'translateY(-10px)' },
//                 ],
//                 {
//                     duration: 500,
//                     easing: 'ease-out',
//                     fill: 'both',
//                 }
//             );

//             setTimeout(function () {
//                 searchBar.style.display = 'none';
//                 buttonSearch.innerHTML =
//                     '<img src="/projets/gitefinder/asset/media/icon/magnifying-glass-solid.svg" alt="">';
//                 menuBurger.style.display = 'block';
//             }, 500);
//         }
//     });

//     window.addEventListener('resize', function () {
//         const currentWidth = window.innerWidth;
//         const isThresholdExceeded = currentWidth == 769;

//         if (isThresholdExceeded !== isAboveThreshold) {
//             isAboveThreshold = isThresholdExceeded;
//             if (isAboveThreshold) {
//                 location.reload(); // Actualiser la page sans recharger
//             }
//         }
//     });
// });



// //menu burger
// let btnBurger = document.querySelector('.menu-burger-header');
// let menuModal = document.getElementById('burger-menu-modal');
// let menuOpen = false; // Booléen pour garder une trace de l'état du menu

// if (btnBurger && menuModal) {
//     btnBurger.addEventListener('click', function (event) {
//         event.stopPropagation();
//         if (menuOpen) {
//             menuModal.style.display = 'none';
//             menuOpen = false;
//         } else {
//             menuModal.style.display = 'flex';
//             menuOpen = true;
//         }
//     });

//     document.addEventListener('click', function () {
//         if (menuOpen) {
//             menuModal.style.display = 'none';
//             menuOpen = false;
//         }
//     });
// }



// // slider image post

// document.addEventListener('DOMContentLoaded', function () {
//     var sliderImages = document.getElementsByClassName('sliderImage');
//     var mainImage = document.getElementById('mainImage');

//     for (var i = 0; i < sliderImages.length; i++) {
//         sliderImages[i].addEventListener('click', function () {
//             var tempSrc = mainImage.src;  // Stocker temporairement l'image principale
//             mainImage.src = this.src;  // Changer l'image principale
//             this.src = tempSrc;  // Changer l'image du slider
//         });
//     }
// });


// // image profil











// document.addEventListener('DOMContentLoaded', function () {
//     let hearts = document.querySelectorAll('.heart-kr');

//     hearts.forEach(heart => {
//         setupHeart(heart);
//     });

//     function setupHeart(heart) {
//         let isFilled = false;

//         heart.addEventListener('click', function () {
//             isFilled = !isFilled;
//             animateHeart(heart, isFilled);
//         });

//         function animateHeart(heartElement, isFilled) {
//             let totalFrames = 28;
//             let frames = Math.floor(totalFrames / 2);
//             let interval = 1000 / frames;

//             let currentFrame = 0;
//             let position = isFilled ? -currentFrame * 100 : 0;

//             let animation = setInterval(function () {
//                 heartElement.style.backgroundPosition = `${position}px 0`;
//                 currentFrame++;

//                 if (currentFrame >= frames) {
//                     clearInterval(animation);
//                 }

//                 position = isFilled ? -currentFrame * 100 : 0;
//             }, interval);
//         }
//     }
// });


document.addEventListener("DOMContentLoaded", function () {
    handleSearchBar();
    handleBurgerMenu();
    handleSliderImages();
    handleHeartAnimation();
});

function handleSearchBar() {
    let buttonSearch = document.querySelector('.button-search');
    let searchBar = document.querySelector('.search-bar-form');
    let menuBurger = document.querySelector('.menu-burger-header');
    let isSearchBarVisible = false;

    if (buttonSearch && searchBar && menuBurger) {
        buttonSearch.addEventListener('click', function (event) {
            event.stopPropagation();
            isSearchBarVisible = !isSearchBarVisible;

            if (isSearchBarVisible) {
                displaySearchBar(searchBar, buttonSearch, menuBurger);
            } else {
                hideSearchBar(searchBar, buttonSearch, menuBurger);
            }
        });
    }
}

function displaySearchBar(searchBar, buttonSearch, menuBurger) {
    searchBar.style.display = 'flex';
    animateElement(searchBar, [
        { opacity: 0, transform: 'translateY(-10px)' },
        { opacity: 1, transform: 'translateY(0)' }
    ]);
    buttonSearch.innerHTML = '<img src="/projets/gitefinder/asset/media/icon/x-solid.svg" alt="">';
    menuBurger.style.display = 'none';
}

function hideSearchBar(searchBar, buttonSearch, menuBurger) {
    animateElement(searchBar, [
        { opacity: 1, transform: 'translateY(0)' },
        { opacity: 0, transform: 'translateY(-10px)' }
    ]);
    setTimeout(function () {
        searchBar.style.display = 'none';
        buttonSearch.innerHTML = '<img src="/projets/gitefinder/asset/media/icon/magnifying-glass-solid.svg" alt="">';
        menuBurger.style.display = 'block';
    }, 500);
}

function animateElement(element, keyframes, options = { duration: 500, easing: 'ease-out', fill: 'both' }) {
    element.animate(keyframes, options);
}

function handleBurgerMenu() {
    let btnBurger = document.querySelector('.menu-burger-header');
    let menuModal = document.getElementById('burger-menu-modal');
    let menuOpen = false;

    if (btnBurger && menuModal) {
        btnBurger.addEventListener('click', function (event) {
            event.stopPropagation();
            menuOpen = !menuOpen;
            menuModal.style.display = menuOpen ? 'flex' : 'none';
        });

        document.addEventListener('click', function () {
            if (menuOpen) {
                menuModal.style.display = 'none';
                menuOpen = false;
            }
        });
    }
}

function handleSliderImages() {
    let sliderImages = document.querySelectorAll('.sliderImage');
    let mainImage = document.getElementById('mainImage');

    if (mainImage) {
        sliderImages.forEach(sliderImage => {
            sliderImage.addEventListener('click', function () {
                let tempSrc = mainImage.src;
                mainImage.src = this.src;
                this.src = tempSrc;
            });
        });
    }
}

function handleHeartAnimation() {
    let hearts = document.querySelectorAll('.heart-kr');

    hearts.forEach(heart => {
        let isFilled = false;

        heart.addEventListener('click', function () {
            isFilled = !isFilled;
            animateHeart(heart, isFilled);
        });
    });
}

function animateHeart(heartElement, isFilled) {
    let totalFrames = 28;
    let frames = Math.floor(totalFrames / 2);
    let interval = 1000 / frames;
    let currentFrame = 0;
    let position = isFilled ? -currentFrame * 100 : 0;

    let animation = setInterval(function () {
        heartElement.style.backgroundPosition = `${position}px 0`;
        currentFrame++;

        if (currentFrame >= frames) {
            clearInterval(animation);
        }

        position = isFilled ? -currentFrame * 100 : 0;
    }, interval);
}
