document.addEventListener('DOMContentLoaded', function () {
    let openModalButton = document.getElementById('openModalButton');
    let modal = document.getElementById('modal');
    let closeBtn = document.getElementsByClassName('close-footer')[0];

    openModalButton.addEventListener('click', function (event) {
        modal.style.display = 'block';
        event.stopPropagation();
    });

    document.addEventListener('click', function (event) {
        if (!modal.contains(event.target) && event.target !== openModalButton) {
            modal.style.display = 'none';
            closeBtn.style.display = 'none';
        }
    });
});
