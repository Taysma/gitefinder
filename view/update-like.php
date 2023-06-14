<?php
// Effectuez ici les opérations nécessaires pour vous connecter à votre base de données

if (isset($_POST['liked'])) {
  $isLiked = $_POST['liked'] === 'true';
  $cardId = 123; // Remplacez 123 par l'ID de votre carte

  // Effectuez ici les opérations pour mettre à jour la base de données avec l'état de like
  // $isLiked contient l'état du like (true pour liké, false pour non liké)
}

// Réponse de la requête AJAX
http_response_code(200); // Code de réussite
exit();
