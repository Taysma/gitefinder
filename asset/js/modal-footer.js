const openModalButton = document.getElementById('openModalButton');
const modal = document.getElementById('modal');
let closeBtn = document.getElementsByClassName('close-footer');
openModalButton.addEventListener('click', function (event) {
    modal.style.display = 'block';
    event.stopPropagation();
});
// closeBtn.addEventListener('click', function (event) {
//     closeBtn.style.display = 'none';
//     event.stopPropagation();
// });

document.addEventListener('click', function (event) {
    if (!modal.contains(event.target) && event.target !== openModalButton) {
        modal.style.display = 'none';

        closeBtn.style.display = 'none';
    }
});
