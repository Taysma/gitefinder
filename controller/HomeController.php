<?php

class HomeController extends Controller
{
    public function home(){
        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();
       
        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    public function addSubscribes(){
        
        global $router;
        $model = new NewsletterModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $mail = $_POST['mail'];
            $subscribe = new Newsletter([ 'mail' => $mail ]);

            $model->createNewSubscribe($subscribe);
            header('Location: ' . $router->generate('home'));
        } else {
            echo self::getRender('homepage.html.twig', []);
        }
    }
}

