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
