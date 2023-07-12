<?php

class HomeController extends Controller
{
    public function home(){
        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();
       
     
        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    

    public function getOne($id_rental, $id_user){
        
        $Rentalmodel = new RentalModel();
        $article = $Rentalmodel->getOneRental($id_rental);
        $UserModel = new UserModel();
        $proprio = $UserModel->getUserById($id_user);
        

        
        
        echo self::getRender('post.html.twig', ['rental' => $article, 'user' => $proprio]);
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

