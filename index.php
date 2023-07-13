<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/gitefinder');

// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');


$router->map('GET','/category/','','baseCats');
$router->map('GET', '/category/[i:id]', 'CategoryController#getOne', '');

// ARTICLE - POST
$router->map('GET', '/rental/', '', 'baseRental');
$router->map('GET', '/rental/[i:id_rental]/[i:id_user]', 'HomeController#getOne', 'article');

// CONNECTION
$router->map('GET|POST', '/login', 'UserController#login', 'login');
$router->map('GET|POST', '/registration', 'UserController#register', 'register');
$router->map('GET', '/logout', 'UserController#logout', 'logout');

// USER
$router->map('GET', '/dashboard', 'UserController#getUserDashboard', 'dashboard');
$router->map('GET', '/dashboard/profil', 'UserController#getUserProfil', 'userProfil');
$router->map('GET', '/dashboard/favoris', 'UserController#getUserFavoris', 'userFavoris');
$router->map('GET', '/dashboard/reservation', 'UserController#getUserReservation', 'userReservations');
// $router->map('GET', '/dashboard/propriete', '', 'userRental'); // ajouter un rental - view à faire

// NEWSLETTER
$router->map('POST', '/newsletter', 'HomeController#addSubscribes', 'newsletter');

// CRUD Post
// $router->map('GET|POST', '/newpost', 'PostController#createPost', 'addPost');
// $router->map('GET|POST', '/post/edit/[i:id]', 'PostController#edit', 'editPost');
// $router->map('POST|DELETE', '/post/delete/[i:id]', 'PostController#delete', 'deletePost');

// // SEARCH
// $router->map('GET', '/search', 'SearchController#searchResult', 'search');

$match = $router->match();
 //var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
} // else { affichage de la page 404}
