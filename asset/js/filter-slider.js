document.addEventListener('DOMContentLoaded', function () {
    // Code JavaScript pour la fonctionnalité du slider
    const container = document.querySelector('.container-filter');
    const btnRight = document.querySelector('.btn-right');
    const btnLeft = document.querySelector('.btn-left');

    btnRight.addEventListener('click', () => {
        container.scrollLeft -= 200; // Défiler vers la droite (ajuster la valeur selon vos besoins)
    });

    btnLeft.addEventListener('click', () => {
        container.scrollLeft += 200; // Défiler vers la gauche (ajuster la valeur selon vos besoins)
    });
});