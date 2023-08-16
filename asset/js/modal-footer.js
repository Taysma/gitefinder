document.addEventListener('DOMContentLoaded', function () {
    let openModalButton = document.getElementById('openModalButton');
    let modal = document.querySelector('.modal');
    let closeBtn = document.getElementsByClassName('close-footer')[0];

    if (openModalButton && modal && closeBtn) {
        openModalButton.addEventListener('click', function (event) {
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', function (event) {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});