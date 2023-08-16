document.addEventListener("DOMContentLoaded", function () {
    let buttonSearch = document.querySelector('.button-search');
    let searchBar = document.querySelector('.search-bar-form');
    let menuBurger = document.querySelectorAll('.menu-burger-header');
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
let btnBurger = document.querySelector('.menu-burger-header');
let menuModal = document.getElementById('burger-menu-modal');
let menuOpen = false; // Booléen pour garder une trace de l'état du menu

if (btnBurger && menuModal) {
    btnBurger.addEventListener('click', function (event) {
        event.stopPropagation();
        if (menuOpen) {
            menuModal.style.display = 'none';
            menuOpen = false;
        } else {
            menuModal.style.display = 'flex';
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







function copyToClipboard(text) {
    var textarea = document.createElement("textarea");
    textarea.textContent = text;
    textarea.style.position = "fixed";
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand("copy");
    } catch (ex) {
        console.warn("Copy to clipboard failed.", ex);
        return false;
    } finally {
        document.body.removeChild(textarea);
    }
}

function shareOnFacebook() {
    const currentURL = window.location.href;
    const fbShareURL = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(currentURL);
    window.open(fbShareURL, '_blank');
}

function shareOnTwitter() {
    const currentURL = window.location.href;
    const twitterShareURL = "https://twitter.com/share?url=" + encodeURIComponent(currentURL);
    window.open(twitterShareURL, '_blank');
}

function shareOnWhatsApp() {
    const currentURL = window.location.href;
    const whatsappShareURL = "https://wa.me/?text=" + encodeURIComponent(currentURL);
    window.open(whatsappShareURL, '_blank');
}

function shareOnInstagram() {
    // Discord n'a pas de lien de partage direct, donc nous copierons simplement l'URL pour l'utilisateur
    const currentURL = window.location.href;
    copyToClipboard(currentURL);
    alert("Lien copié dans le presse-papiers. Collez-le dans Discord pour le partager !");
    // const currentURL = window.location.href;
    // const twitterShareURL = "https://www.instagram.com/share?url=" + encodeURIComponent(currentURL);
    // window.open(twitterShareURL, '_blank');
}



// Attacher les écouteurs d'événements aux boutons
document.getElementById('facebookShareButton').addEventListener('click', shareOnFacebook);
document.getElementById('twitterShareButton').addEventListener('click', shareOnTwitter);
document.getElementById('whatsappShareButton').addEventListener('click', shareOnWhatsApp);
document.getElementById('instagramShareButton').addEventListener('click', shareOnInstagram);







