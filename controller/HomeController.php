<?php

class HomeController extends Controller
{
    public function home(){
        $Rentalmodel = new RentalModel();
        $rentals = $Rentalmodel->getAllrentals();

        
        
        $picture = $Rentalmodel->getRentalPicture($id_picture);

        if($picture === false){
            echo "image inexistante";
        }else{
            echo self::getRender('homePage.html.twig', ['rentals' => $rentals, 'picture' => $picture]);
        }

        
    }

    

    public function getOne($id){

        
        echo self::getRender('article.html.twig', []);
    }
}
