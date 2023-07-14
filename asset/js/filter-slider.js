document.addEventListener('DOMContentLoaded', function () {
    var filterBar = document.getElementById('filter-bar');

    // Get the width of a single filter element, including margins
    var filterWidth = filterBar.querySelector('.filter').offsetWidth;
    var filterStyle = window.getComputedStyle(filterBar.querySelector('.filter'));
    var filterMargin = parseFloat(filterStyle.marginLeft) + parseFloat(filterStyle.marginRight);
    var scrollWidth = filterWidth + filterMargin;

    function scrollLeft() {
        filterBar.scrollBy({ left: -scrollWidth, behavior: 'smooth' });
    }

    function scrollRight() {
        filterBar.scrollBy({ left: scrollWidth, behavior: 'smooth' });
    }

    document.querySelector('.arrow.left').addEventListener('click', scrollLeft);
    document.querySelector('.arrow.right').addEventListener('click', scrollRight);
});
