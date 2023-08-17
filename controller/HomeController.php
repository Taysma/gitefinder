<?php

class HomeController extends Controller
{
    public function home()
    {
        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();

        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {
            $model = new WishlistModel();
            $wishlist = $model->getWish();

            $rentalIdsInWishlist = [];
            foreach ($wishlist as $wishItem) {
                $rentalIdsInWishlist[] = $wishItem->getId_rental();
            }

            echo self::getRender('homePage.html.twig', ['rentals' => $rentals, 'rentalIdsInWishlist' => $rentalIdsInWishlist,]);
        } else {
            echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
        }
    }

    public function addSubscribes()
    {
        global $router;
        $model = new NewsletterModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $mail = $_POST['mail'];
            $subscribe = new Newsletter(['mail' => $mail]);

            $model->createNewSubscribe($subscribe);
            header('Location: ' . $router->generate('home'));
        } else {
            echo self::getRender('homepage.html.twig', []);
        }
    }
}
