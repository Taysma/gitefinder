<?php

class HomeController extends Controller
{
    public function home(){
        $Rentalmodel = new RentalModel();
        $rentals = $Rentalmodel->getAllrentals();
        
        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    

    public function getOne($id_rental){
        global $router;
        $Rentalmodel = new RentalModel();
        $article = $Rentalmodel->getOneRental($id_rental);
        $oneRental = $router->generate('article');
        
        echo self::getRender('post.html.twig', ['rental' => $article, 'oneRental' => $oneRental]);
    }


    public function addSubscribes(){
        global $router;
        $model = new NewsletterModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $mail = $_POST['mail'];
            
            
            $subscribe = new Newsletter([
                
                'mail' => $mail,
                
                
            ]);

            $model->createNewSubscribe($subscribe);
            header('Location: ' . $router->generate('home'));
        } else {
            echo self::getRender('homepage.html.twig', []);
        }
    }












}

