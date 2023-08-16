// const inputFile = document.getElementById('file-input');
// const inputText = document.getElementById('message-input');

// inputFile.addEventListener('change', function () {
//     if (this.files && this.files[0]) {
//         const file = this.files[0];

//         if (file.type.startsWith('image/')) {
//             const reader = new FileReader();
//             reader.readAsDataURL(file);

//             reader.onload = function (e) {
//                 inputText.style.backgroundImage = `url(${e.target.result})`;
//                 inputText.style.backgroundSize = '50px 50px';
//                 // inputText.style.backgroundPosition = 'center';
//                 inputText.style.backgroundRepeat = "no-repeat";
//             };
//         } else {
//             inputText.value = '';
//             inputText.style.backgroundImage = 'none';
//             alert('Veuillez sélectionner une image.');
//         }
//     }
// });




const inputFile = document.getElementById('file-input');
const inputText = document.getElementById('message-input');
const container = document.getElementById('container');

inputFile.addEventListener('change', function () {
    if (this.files && this.files[0]) {
        const file = this.files[0];

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = function (e) {
                // Création dynamique de l'élément <div> pour le conteneur de l'image et du texte
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');

                // Création dynamique de l'élément <img> pour afficher l'image
                const imageElement = document.createElement('img');
                imageElement.src = e.target.result;
                imageElement.alt = 'Aperçu de l\'image';
                imageElement.style.width = '50px';
                imageElement.style.height = '50px';

                // Ajout de l'élément <img> au conteneur
                imageContainer.appendChild(imageElement);

                // Ajout du texte à l'intérieur du conteneur
                const textElement = document.createElement('p');
                textElement.textContent = inputText.value;
                imageContainer.appendChild(textElement);

                // Ajout du conteneur à l'élément parent spécifié dans votre HTML
                container.appendChild(imageContainer);
            };
        } else {
            inputText.value = '';
            alert('Veuillez sélectionner une image.');
        }
    }
});