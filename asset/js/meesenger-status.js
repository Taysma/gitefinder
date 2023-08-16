// function checkUserStatus() {
//     // Envoyer une requête AJAX au serveur pour vérifier l'état de connexion
//     // Utilisez l'URL appropriée pour votre serveur et ajoutez les paramètres nécessaires

//     fetch('/check-user-status')
//         .then(response => response.text())
//         .then(data => {
//             // Si la réponse du serveur indique que l'utilisateur est en ligne
//             if (data === 'online') {
//                 // Mettre à jour l'indicateur d'état de connexion avec un point vert
//                 document.querySelector('.status').classList.add('online');
//             } else {
//                 // Mettre à jour l'indicateur d'état de connexion avec un point gris
//                 document.querySelector('.status').classList.remove('online');
//             }
//         })
//         .catch(error => {
//             // En cas d'erreur lors de la vérification, supposons que l'utilisateur est hors ligne
//             document.querySelector('.status').classList.remove('online');
//         });
// }

// // Appeler la fonction pour vérifier l'état de connexion au chargement de la page
// document.addEventListener('DOMContentLoaded', checkUserStatus);



// function checkUserStatus() {
//     // Envoyer une requête AJAX au serveur pour vérifier l'état de connexion
//     // Utilisez l'URL appropriée pour votre serveur et ajoutez les paramètres nécessaires

//     fetch('URL_DU_SERVEUR', {
//         method: 'GET',
//         credentials: 'include' // Si votre serveur nécessite des cookies pour l'authentification
//     })
//         .then(response => {
//             if (response.ok) {
//                 return 'online';
//             } else {
//                 return 'offline';
//             }
//         })
//         .then(status => {
//             // Mettre à jour l'indicateur d'état de connexion en fonction du statut
//             const statusIndicator = document.querySelector('.status');
//             if (status === 'online') {
//                 statusIndicator.classList.add('online');
//             } else {
//                 statusIndicator.classList.remove('online');
//             }
//         })
//         .catch(error => {
//             console.error('Erreur lors de la vérification de l\'état de connexion :', error);
//         });
// }

// // Appeler la fonction pour vérifier l'état de connexion au chargement de la page
// document.addEventListener('DOMContentLoaded', checkUserStatus);


// version socket 
import io from 'socket.io-client';
const socket = io('URL_DU_SERVEUR');

socket.on('connect', () => {
    socket.emit('identify', { userId: 'ID_UTILISATEUR' });
});

socket.on('disconnect', () => {
    // Gérer la déconnexion de l'utilisateur
    // Mettre à jour l'interface utilisateur, etc.
    document.querySelector('.status').classList.remove('online');
});

socket.on('userStatusUpdate', ({ userId, status }) => {
    // Mettre à jour l'état de connexion de l'utilisateur spécifié (userId)
    // Mettre à jour l'interface utilisateur en conséquence
    if (status === 'online') {
        document.querySelector('.status').classList.add('online');
    } else {
        document.querySelector('.status').classList.remove('online');
    }
});