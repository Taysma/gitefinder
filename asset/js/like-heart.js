// Vérifiez si le cookie 'userLoggedIn' est défini
var isLoggedIn = document.cookie.split(';').some((item) => item.trim().startsWith('userLoggedIn='));

document.addEventListener('DOMContentLoaded', function () {
    var heartIcons = document.getElementsByClassName('heart');

    for (var i = 0; i < heartIcons.length; i++) {
        var heartIcon = heartIcons[i];

        heartIcon.addEventListener('click', function () {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            if (!isLoggedIn) {
                window.location.href = '/projets/gitefinder/login';
                return;
            }

            var likeCount = this.dataset.likeCount ? Number(this.dataset.likeCount) : 0;
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

            this.dataset.likeCount = likeCount;

            // Envoi de la requête AJAX au serveur
            fetch('WishlistModel.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_user=' + userId + '&id_rental=' + this.dataset.giteId
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