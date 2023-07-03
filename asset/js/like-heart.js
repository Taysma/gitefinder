document.addEventListener('DOMContentLoaded', function () {
    var heartIcons = document.getElementsByClassName('heart');

    for (var i = 0; i < heartIcons.length; i++) {
        var heartIcon = heartIcons[i];
        var likeCount = 0;

        heartIcon.addEventListener('click', function () {
            likeCount++;

            if (likeCount % 2 === 1) {
                this.classList.remove('fa-regular');
                this.classList.add('fa-solid');
                this.classList.add('filled');
                this.classList.remove('empty');
            } else {
                this.classList.add('fa-regular');
                this.classList.remove('fa-solid');
                this.classList.remove('filled');
                this.classList.add('empty');
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
    }
});




