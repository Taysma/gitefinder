// document.addEventListener('DOMContentLoaded', function () {
//     const heartIcons = document.getElementsByClassName('heart');

//     for (let i = 0; i < heartIcons.length; i++) {
//         const heartIcon = heartIcons[i];

//         heartIcon.addEventListener('click', function () {

//             let likeCount = this.dataset.likeCount ? Number(this.dataset.likeCount) : 0;
//             likeCount++;

//             if (likeCount % 2 === 1) {
//                 this.classList.remove('fa-regular');
//                 this.classList.add('fa-solid');
//                 this.classList.add('filled');
//                 this.classList.remove('empty');
//             } else {
//                 this.classList.add('fa-regular');
//                 this.classList.remove('fa-solid');
//                 this.classList.remove('filled');
//                 this.classList.add('empty');
//             }

//             this.dataset.likeCount = likeCount;


//             const idRental = this.dataset.giteId;
//             const method = this.classList.contains('filled') ? 'DELETE' : 'POST';

//             // Make an AJAX request to the server
//             fetch('./controller/UserController.php', {
//                 method: method,
//                 headers: {
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({
//                     id_rental: idRental,
//                     method: method
//                 })
//             })
//                 .then(response => {
//                     console.log('Response:', response);
//                     return response.json();
//                 })

//                 .catch(error => {
//                     console.error('Error:', error);
//                 });

//         });
//     }
// });