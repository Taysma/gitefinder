document.addEventListener('DOMContentLoaded', function () {
    var heartIcon = document.getElementById('heart');
    var likeCount = 0;

    heartIcon.addEventListener('click', function () {
        likeCount++;

        if (likeCount % 2 === 1) {
            heartIcon.classList.remove('fa-regular');
            heartIcon.classList.add('fa-solid');
            heartIcon.classList.add('filled');
            heartIcon.classList.remove('empty');
        } else {
            heartIcon.classList.add('fa-regular');
            heartIcon.classList.remove('fa-solid');
            heartIcon.classList.remove('filled');
            heartIcon.classList.add('empty');
        }

        // Envoi de la requête AJAX au serveur
        fetch('update-like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'likeCount=' + likeCount
        })
            .then(function (response) {
                if (response.ok) {
                    // Requête réussie
                    console.log('Le like a été mis à jour avec succès');
                } else {
                    // Erreur lors de la requête
                    console.log('Une erreur s\'est produite lors de la mise à jour du like');
                }
            })
            .catch(function (error) {
                // Erreur lors de la requête
                console.log('Une erreur s\'est produite lors de la mise à jour du like :', error);
            });
    });
});




// document.addEventListener('DOMContentLoaded', function () {
//     var heartIcon = document.getElementById('heart');
//     var isLiked = false;

//     heartIcon.addEventListener('click', function () {
//         isLiked = !isLiked;
//         heartIcon.classList.toggle('red');

//         // Envoi de la requête AJAX au serveur
//         fetch('update-like.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded'
//             },
//             body: 'liked=' + (isLiked ? 'true' : 'false')
//         })
//             .then(function (response) {
//                 if (response.ok) {
//                     // Requête réussie
//                     console.log('Le like a été mis à jour avec succès');
//                 } else {
//                     // Erreur lors de la requête
//                     console.log('Une erreur s\'est produite lors de la mise à jour du like');
//                 }
//             })
//             .catch(function (error) {
//                 // Erreur lors de la requête
//                 console.log('Une erreur s\'est produite lors de la mise à jour du like :', error);
//             });
//     });
// });
