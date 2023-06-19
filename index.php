<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/gitefinder');



// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');

//  HOMEPAGE // Affichages des contenues de la homepage
$router->map('GET', '/rental/', '', 'baseRental');
$router->map('GET', '/rental/[i:id_rental]', 'HomeController#getOne', 'article');


$router->map('GET','/category/','','baseCats');
$router->map('GET', '/category/[i:id]', 'CategoryController#getOne', '');

// Connection form route
$router->map('GET|POST', '/login', 'UserController#login', 'login');
$router->map('POST', '/registration', 'UserController#register', 'register');
$router->map('GET', '/logout', 'UserController#logout', 'logout');

// USER
$router->map('GET', '/dashboard', 'RentalController#getUserRental', 'dashboard');

// ajout d'abonnés a la newsletter
$router->map('POST', '/newsletter', 'HomeController#addSubscribes', 'newsletter');

// CRUD Post
// $router->map('GET|POST', '/newpost', 'PostController#createPost', 'addPost');
// $router->map('GET|POST', '/post/edit/[i:id]', 'PostController#edit', 'editPost');
// $router->map('POST|DELETE', '/post/delete/[i:id]', 'PostController#delete', 'deletePost');


// // SEARCH
// $router->map('GET', '/search', 'SearchController#searchResult', 'search');


$match = $router->match();
 var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
} // else { affichage de la page 404}
