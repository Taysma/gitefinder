document.addEventListener('DOMContentLoaded', function () {
    let openModalButton = document.getElementById('openModalButton');
    let modal = document.getElementById('modal');
    let closeBtn = document.getElementsByClassName('close-footer')[0];

    if (openModalButton && modal && closeBtn) {
        openModalButton.addEventListener('click', function (event) {
            modal.style.display = 'block';
            closeBtn.style.display = 'block';
            event.stopPropagation();
        });

        closeBtn.addEventListener('click', function (event) {
            modal.style.display = 'none';
            closeBtn.style.display = 'none';
            event.stopPropagation();
        });

        document.addEventListener('click', function (event) {
            if (!modal.contains(event.target) && event.target.id !== 'openModalButton') {
                modal.style.display = 'none';
                closeBtn.style.display = 'none';
            }
        });
    }
});
