document.addEventListener('DOMContentLoaded', function () {
    var filterBar = document.getElementById('filter-bar');

    // Get the width of a single filter element, including margins
    var filterWidth = filterBar.querySelector('.filter-image-name').offsetWidth;
    var filterStyle = window.getComputedStyle(filterBar.querySelector('.filter-image-name'));
    var filterMargin = parseFloat(filterStyle.marginLeft) + parseFloat(filterStyle.marginRight);
    var scrollWidth = filterWidth + filterMargin;

    function scrollLeft() {
        filterBar.scrollBy({ left: -scrollWidth, behavior: 'smooth' });

        // Check if we have reached the beginning of the filter bar
        var scrollLeft = filterBar.scrollLeft;

        if (scrollLeft === 0) {
            // Hide the left arrow
            document.querySelector('.arrow.left').style.display = 'none';
        } else {
            // Show the left arrow
            document.querySelector('.arrow.left').style.display = 'block';
        }

        // Show the right arrow
        document.querySelector('.arrow.right').style.display = 'block';
    }

    function scrollRight() {
        filterBar.scrollBy({ left: scrollWidth, behavior: 'smooth' });

        // Check if we have reached the end of the filter bar
        var scrollLeft = filterBar.scrollLeft;
        var maxScrollLeft = filterBar.scrollWidth - filterBar.clientWidth;

        if (scrollLeft >= maxScrollLeft) {
            // Hide the right arrow
            document.querySelector('.arrow.right').style.display = 'none';
        } else {
            // Show the right arrow
            document.querySelector('.arrow.right').style.display = 'block';
        }

        // Show the left arrow
        document.querySelector('.arrow.left').style.display = 'block';
    }

    // Check if we need to show or hide the arrows initially
    filterBar.addEventListener('scroll', function () {
        var scrollLeft = filterBar.scrollLeft;
        var maxScrollLeft = filterBar.scrollWidth - filterBar.clientWidth;

        if (scrollLeft === 0) {
            // Hide the left arrow
            document.querySelector('.arrow.left').style.display = 'none';
        } else if (scrollLeft >= maxScrollLeft) {
            // Hide the right arrow
            document.querySelector('.arrow.right').style.display = 'none';
        } else {
            // Show both arrows
            document.querySelector('.arrow.left').style.display = 'block';
            document.querySelector('.arrow.right').style.display = 'block';
        }
    });

    // Hide the right arrow initially if there are no categories to scroll
    var categories = filterBar.querySelectorAll('.filter-image-name');
    if (categories.length <= 1) {
        document.querySelector('.arrow.right').style.display = 'none';
    }

    document.querySelector('.arrow.left').addEventListener('click', scrollLeft);
    document.querySelector('.arrow.right').addEventListener('click', scrollRight);
});
