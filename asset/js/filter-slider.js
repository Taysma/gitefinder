document.addEventListener('DOMContentLoaded', function () {
    var filterBar = document.getElementById('filter-bar');

    // Si filterBar n'existe pas, on quitte la fonction
    if (!filterBar) {
        return;
    }

    var filterImageName = filterBar.querySelector('.filter-image-name');

    // Si filterImageName n'existe pas, on quitte la fonction
    if (!filterImageName) {
        return;
    }

    var arrowLeft = document.querySelector('.arrow.left');
    var arrowRight = document.querySelector('.arrow.right');

    // Si les flèches n'existent pas, on quitte la fonction
    if (!arrowLeft || !arrowRight) {
        return;
    }

    // Get the width of a single filter element, including margins
    var filterWidth = filterImageName.offsetWidth;
    var filterStyle = window.getComputedStyle(filterImageName);
    var filterMargin = parseFloat(filterStyle.marginLeft) + parseFloat(filterStyle.marginRight);
    var scrollWidth = filterWidth + filterMargin;

    function scrollLeft() {
        filterBar.scrollBy({ left: -scrollWidth, behavior: 'smooth' });

        // Check if we have reached the beginning of the filter bar
        var scrollLeft = filterBar.scrollLeft;

        if (scrollLeft === 0) {
            arrowLeft.style.display = 'none';
        } else {
            arrowLeft.style.display = 'block';
        }

        // Show the right arrow
        arrowRight.style.display = 'block';
    }

    function scrollRight() {
        filterBar.scrollBy({ left: scrollWidth, behavior: 'smooth' });

        // Check if we have reached the end of the filter bar
        var scrollLeft = filterBar.scrollLeft;
        var maxScrollLeft = filterBar.scrollWidth - filterBar.clientWidth;

        if (scrollLeft >= maxScrollLeft) {
            // Hide the right arrow
            arrowRight.style.display = 'none';
        } else {
            // Show the right arrow
            arrowRight.style.display = 'block';
        }

        // Show the left arrow
        arrowLeft.style.display = 'block';
    }

    // Check if we need to show or hide the arrows initially
    filterBar.addEventListener('scroll', function () {
        var scrollLeft = filterBar.scrollLeft;
        var maxScrollLeft = filterBar.scrollWidth - filterBar.clientWidth;

        if (scrollLeft === 0) {
            arrowLeft.style.display = 'none';
        } else if (scrollLeft >= maxScrollLeft) {
            arrowRight.style.display = 'none';
        } else {
            // Show both arrows
            arrowLeft.style.display = 'block';
            arrowRight.style.display = 'block';
        }
    });

    // Hide the right arrow initially if there are no categories to scroll
    var categories = filterBar.querySelectorAll('.filter-image-name');
    if (categories.length <= 1) {
        arrowRight.style.display = 'none';
    }

    arrowLeft.addEventListener('click', scrollLeft);
    arrowRight.addEventListener('click', scrollRight);
});