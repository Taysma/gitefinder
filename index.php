<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/Projet/GiteFinder');


// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');

//  HOMEPAGE // Affichages des contenues de la homepage
// Add homepage content

// Log-in/out form route
$router->map('GET|POST','/login', 'UserController#login', 'login');
$router->map('GET','/logout', 'UserController#logout', 'logout');
// Register
$router->map('GET|POST','/registration', 'UserController#register', 'register');

// USER
$router->map('GET', '/dashboard', 'PostController#getUserPost', 'dashboardHost');
$router->map('GET', '/dashboard', 'PostController#getUserPost', 'dashboardGuest');
$router->map('GET', '/dashboard', 'PostController#getUserPost', 'dashboardAdmin');

// CRUD Post
$router->map('GET|POST', '/newpost', 'PostController#createPost', 'addPost');
$router->map('GET|POST', '/post/edit/[i:id]', 'PostController#edit', 'editPost');
$router->map('POST|DELETE', '/post/delete/[i:id]', 'PostController#delete', 'deletePost');


// SEARCH
$router->map('GET', '/search', 'SearchController#searchResult', 'search');


$match = $router->match();
// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
} // else { affichage de la page 404}
