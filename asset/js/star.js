document.addEventListener('DOMContentLoaded', function () {
    var stars = document.getElementsByClassName('star');
    var rating = 0;

    for (var i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function () {
            var starId = this.id;
            var starIndex = parseInt(starId.substr(4)); // Extrait l'index de l'ID de l'étoile

            // Si l'utilisateur clique sur l'étoile déjà sélectionnée, réinitialisez toutes les étoiles et le rating
            if (starIndex + 1 === rating) {
                for (var j = 0; j < stars.length; j++) {
                    stars[j].classList.add('far', 'empty');
                    stars[j].classList.remove('fas', 'filled');
                }
                rating = 0;
            } else {
                // Mettre à jour la sélection des étoiles
                for (var j = 0; j < stars.length; j++) {
                    if (j <= starIndex) {
                        stars[j].classList.add('fas', 'filled');
                        stars[j].classList.remove('far', 'empty');
                    } else {
                        stars[j].classList.add('far', 'empty');
                        stars[j].classList.remove('fas', 'filled');
                    }
                }
                // Mettre à jour le niveau d'évaluation
                rating = starIndex + 1;
            }

            // Obtenir userId et giteId
            var userId = this.getAttribute('data-user-id');
            var giteId = this.getAttribute('data-gite-id');

            if (!userId || !giteId) {
                console.error('Erreur : userId ou giteId non définis.');
                return;
            }

            // Envoi de la requête AJAX au serveur
            fetch('update-rating.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'userId=' + userId + '&giteId=' + giteId + '&rating=' + rating
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