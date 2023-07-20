<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/gitefinder');

// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');

$router->map('GET', '/category/', '', 'baseCats');
$router->map('GET', '/category/[i:id_category]', 'CategoryController#getOne', '');

// CONNECTION
$router->map('GET|POST', '/login', 'UserController#login', 'login');
$router->map('GET|POST', '/registration', 'UserController#register', 'register');
$router->map('GET', '/logout', 'UserController#logout', 'logout');

// NEWSLETTER
$router->map('POST', '/newsletter', 'HomeController#addSubscribes', 'newsletter');

// ARTICLE - POST
$router->map('GET', '/article/', '', 'baseRental');
$router->map('GET', '/article/[i:id_rental]', 'RentalController#getOne', '');

// ARTICLE - CRUD
// $router->map('GET|POST', '/nouveau', 'RentalController#createPost', 'addPost');
// $router->map('GET|POST', '/modifier/[i:id]', 'RentalController#edit', 'updatePost');
// $router->map('POST|DELETE', '/supprimer/[i:id]', 'RentalController#delete', 'deletePost');

// USER
$router->map('GET', '/dashboard', 'UserController#getUserDashboard', 'dashboard');
// USER - PROFIL
$router->map('GET', '/dashboard/profil', 'UserController#getUserProfil', 'userProfil');
$router->map('GET|POST', '/dashboard/profil/edit', 'UserController#userProfilUpdate', 'editUserProfil');
$router->map('POST', '/dashboard/profil/delete', 'UserController#userProfilDelete', 'deleteUserProfil');
// USER - PROPRIETE
$router->map('GET', '/dashboard/propriete', 'UserController#getUserProperty', 'userProperty');
$router->map('GET|POST', '/dashboard/nouveau', 'UserController#addProperty', 'addProperty');
$router->map('GET|POST', '/dashboard/update/[i:id]', 'UserController#addProperty', 'editProperty');
$router->map('GET|DELETE', '/dashboard/delete/[i:id]', 'UserController#addProperty', 'deleteProperty');
// USER - FAVORIS
$router->map('GET', '/dashboard/favoris', 'UserController#getUserFavoris', 'userFavoris');
// $router->map('GET', '/dashboard/favoris/delete/[i:id]', 'UserController#deleteFromWishlist', 'deleteFavoris');
// USER - MESSAGERIE
$router->map('GET', '/dashboard/messagerie', 'UserController#getUserMessagerie', 'userMessagerie');
// USER - RESERVATION
$router->map('GET', '/dashboard/reservation', 'UserController#getUserReservation', 'userReservations');

// // SEARCH
// $router->map('GET', '/search', 'SearchController#searchResult', 'search');

$match = $router->match();
// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    } else {
        $errorController = new ErrorController();
        $errorController->handle404();
    }
} else {
    $errorController = new ErrorController();
    $errorController->handle404();
}