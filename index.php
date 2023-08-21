<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/gitefinder');

//                                        HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');

//                                     HOMEPAGE - POST
$router->map('GET', '/article/', '', 'baseRental');
$router->map('GET|POST', '/article/[i:id_rental]', 'RentalController#getOne', '');

//                                        CATEGORIES
$router->map('GET', '/category/', '', 'baseCats');
$router->map('GET', '/category/[i:id_category]', 'RentalController#getOneCategory', '');

//                                        CONNECTION
$router->map('GET|POST', '/login', 'UserController#login', 'login');
$router->map('GET|POST', '/registration', 'UserController#register', 'register');
$router->map('GET', '/logout', 'UserController#logout', 'logout');

//                                        NEWSLETTER
$router->map('POST', '/newsletter', 'HomeController#addSubscribes', 'newsletter');

//                                       USER - DASHBOARD
$router->map('GET', '/dashboard', 'UserController#getUserDashboard', 'dashboard');

//                                       USER - PROFIL
$router->map('GET', '/dashboard/profil', 'UserController#getUserProfil', 'userProfil');
$router->map('GET|POST', '/dashboard/profil/edit', 'UserController#editProfil', 'editUserProfil');
$router->map('GET|POST', '/dashboard/profil/edit/avatar', 'UserController#editAvatar', 'editUserAvatar');
$router->map('POST', '/dashboard/profil/delete', 'UserController#deleteProfil', 'deleteUserProfil');

//                                       USER - PROPRIETE
$router->map('GET', '/dashboard/propriete', 'UserController#getUserProperty', 'userProperty');
$router->map('GET|POST', '/dashboard/nouveau', 'UserController#addProperty', 'addProperty');
$router->map('GET|POST', '/dashboard/modifier', 'UserController#editProperty', 'editProperty');
$router->map('POST', '/dashboard/supprimer', 'UserController#deleteProperty', 'deleteProperty');

//                                       USER - FAVORIS
$router->map('GET', '/dashboard/favoris', 'UserController#getUserWishlist', 'userFavoris');
$router->map('GET', '/dashboard/favoris/nouveau/', '', 'addFavoris');
$router->map('GET', '/dashboard/favoris/nouveau/[i:id_rental]', 'UserController#addToWishlist', '');
$router->map('GET', '/dashboard/favoris/supprimer/', '', 'deleteFavoris');
$router->map('GET', '/dashboard/favoris/supprimer/[i:id_rental]', 'UserController#deleteFromWishlist', '');

//                                       USER - RESERVATION
$router->map('GET', '/dashboard/reservation', 'UserController#getUserReservation', 'userReservations');
$router->map('POST', '/nouveau', 'RentalController#newReservation', 'addReservation');
$router->map('POST', '/delete', 'UserController#deleteReservation', 'deleteReservation');

//                                       USER - MESSAGERIE
$router->map('GET', '/dashboard/messagerie', 'UserController#getUserMessagerie', 'userMessagerie');

//                                            SEARCH
// $router->map('GET', '/search', 'SearchController#searchResult', 'search');

$match = $router->match();

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