<?php
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=nom_de_votre_base_de_donnees;charset=utf8', 'username', 'password');

// Récupérer les données POST
$userId = $_POST['userId'];
$giteId = $_POST['giteId'];
$rating = $_POST['rating'];

// Préparer la requête SQL
$query = $db->prepare('
    INSERT INTO ratings (userId, giteId, rating)
    VALUES (:userId, :giteId, :rating)
    ON DUPLICATE KEY UPDATE rating = :rating
');

// Exécuter la requête SQL
$result = $query->execute([
    'userId' => $userId,
    'giteId' => $giteId,
    'rating' => $rating
]);

// Vérifier le résultat de la requête
if ($result) {
    http_response_code(200);
    echo 'Rating updated successfully';
} else {
    http_response_code(500);
    echo 'Error updating rating';
}
