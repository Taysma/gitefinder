<?php
// update-like.php
// Database connection code goes here

// Récupération de l'ID de l'utilisateur et de l'ID du gîte
$userId = $_POST['userId'];
$giteId = $_POST['giteId'];

$query = "INSERT INTO wishlist (id_user, id_rental) VALUES (:userId, :giteId)";

$stmt = $pdo->prepare($query);
$stmt->execute(['userId' => $userId, 'giteId' => $giteId]);

// Rest of the PHP code goes here
