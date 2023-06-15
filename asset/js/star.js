document.addEventListener('DOMContentLoaded', function () {
    var stars = document.getElementsByClassName('star');
    var rating = 0;

    for (var i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function () {
            var starId = this.id;
            var starIndex = parseInt(starId.substr(4)); // Extrait l'index de l'ID de l'étoile

            // Mettre à jour la sélection des étoiles
            for (var j = 0; j < stars.length; j++) {
                if (j <= starIndex) {
                    stars[j].classList.add('filled');
                    stars[j].classList.remove('fa-regular');
                    stars[j].classList.add('fa-solid');
                } else {
                    stars[j].classList.remove('filled');
                    stars[j].classList.add('fa-regular');
                    stars[j].classList.remove('fa-solid');
                }
            }

            // Mettre à jour le niveau d'évaluation
            rating = starIndex + 1;

            // Envoi de la requête AJAX au serveur
            fetch('update-rating.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'rating=' + rating
            })
                .then(function (response) {
                    if (response.ok) {
                        // Requête réussie
                        console.log('Le niveau d\'évaluation a été mis à jour avec succès');
                    } else {
                        // Erreur lors de la requête
                        console.log('Une erreur s\'est produite lors de la mise à jour du niveau d\'évaluation');
                    }
                })
                .catch(function (error) {
                    // Erreur lors de la requête
                    console.log('Une erreur s\'est produite lors de la mise à jour du niveau d\'évaluation :', error);
                });
        });
    }
});
