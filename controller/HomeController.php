<?php

class HomeController extends Controller
{
    public function home(){
        $Rentalmodel = new RentalModel();
        $rentals = $Rentalmodel->getAllrentals();
        
        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    

    public function getOne($id){

        
        echo self::getRender('article.html.twig', []);
    }
}
