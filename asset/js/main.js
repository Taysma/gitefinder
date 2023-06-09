document.addEventListener('DOMContentLoaded', function () {
    let buttonSearch = document.getElementsByClassName('button-search')[0];
    let searchBar = document.getElementsByClassName('search-bar-form')[0];
    let isSearchBarVisible = false;

    buttonSearch.addEventListener('click', function (event) {
        event.stopPropagation();
        if (isSearchBarVisible) {
            searchBar.animate([
                { opacity: 1, transform: 'translateY(0)' },
                { opacity: 0, transform: 'translateY(-10px)' }
            ], {
                duration: 500,
                easing: 'ease-out',
                fill: 'both'
            });
            buttonSearch.innerHTML = '<img src="../asset/media/images/magnifying-glass-solid.svg" alt="">';

            setTimeout(function () {
                searchBar.style.display = 'none';
            }, 500); // Attendre la fin de l'animation avant de masquer complètement la zone de recherche
        } else {
            searchBar.style.display = 'flex';
            searchBar.animate([
                { opacity: 0, transform: 'translateY(-10px)' },
                { opacity: 1, transform: 'translateY(0)' }
            ], {
                duration: 500,
                easing: 'ease-out',
                fill: 'both'
            });
            buttonSearch.innerHTML = '<img src="../asset/media/images/x-solid.svg" alt="">';
        }
        isSearchBarVisible = !isSearchBarVisible;
    });

    document.addEventListener('click', function (event) {
        if (window.innerWidth <= 750) {
            if (!searchBar.contains(event.target) && event.target !== buttonSearch) {
                searchBar.animate([
                    { opacity: 1, transform: 'translateY(0)' },
                    { opacity: 0, transform: 'translateY(-10px)' }
                ], {
                    duration: 500,
                    easing: 'ease-out',
                    fill: 'both'
                });
                buttonSearch.innerHTML = '<img src="../asset/media/images/magnifying-glass-solid.svg" alt="">';

                setTimeout(function () {
                    searchBar.style.display = 'none';
                }, 500); // Attendre la fin de l'animation avant de masquer complètement la zone de recherche

                isSearchBarVisible = false;
            } else {
                searchBar.style.display = 'flex';
                searchBar.animate([
                    { opacity: 0, transform: 'translateY(-10px)' },
                    { opacity: 1, transform: 'translateY(0)' }
                ], {
                    duration: 500,
                    easing: 'ease-out',
                    fill: 'both'
                });
                buttonSearch.innerHTML = '<img src="../asset/media/images/x-solid.svg" alt="">';
            }
            isSearchBarVisible = !isSearchBarVisible;
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth === 750) {
            document.body.style.width = '100%';
            location.reload(); // Actualiser la page
        }
    });
});


