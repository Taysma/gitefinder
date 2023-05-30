<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/gitefinder');


// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');

//  HOMEPAGE // Affichages des contenues de la homepage


// Log-in/out form route
$router->map('GET|POST','/login', 'UserController#login', 'login');
$router->map('GET','/logout', 'UserController#logout', 'logout');
// Register
$router->map('GET|POST','/registration', 'UserController#register', 'register');

// USER
$router->map('GET', '/account', 'RecipeController#getUserRecipe', 'account');

// CRUD RECIPE
$router->map('GET|POST', '/addrecipe', 'RecipeController#createRecipe', 'recipeAdd');

$router->map('GET|POST', '/recipe/edit/[i:id]', 'RecipeController#edit', 'editRecipe');

$router->map('POST|DELETE', '/recipe/delete/[i:id]', 'RecipeController#delete', 'deleteRecipe');


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
