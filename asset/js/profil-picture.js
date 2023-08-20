// image profil


document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez l'élément de la photo de profil et l'input de téléchargement de fichier
    const profilePicture = document.getElementById('profile-picture');
    const profileUpload = document.getElementById('profile-upload');

    // Fonction pour mettre à jour l'image de profil
    function updatePicture(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function () {
            profilePicture.style.backgroundImage = `url(${reader.result})`;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Ajoutez un événement de changement de fichier à l'input de téléchargement
    profileUpload.addEventListener('change', updatePicture);
});

// edit profil
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        let btnIconEdit = document.getElementById('edit-icon');
        let containerProfil = document.getElementsByClassName('profil-information')[0];
        let containerInformationProfil = document.getElementsByClassName('name-lastname-email-number')[0];
        let containerTitle = document.getElementsByClassName('title-img-btn')[0]; // Correction ici

        btnIconEdit.addEventListener('click', function () {
            containerProfil.style.display = "block";
            containerInformationProfil.style.display = "none";
            containerTitle.style = "margin:auto;";
        });
    }, 2000); // 2000ms or 2 seconds delay
});
