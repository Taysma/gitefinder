<?php
class RentalController extends Controller
{

    public function getUserRental()
    {
        // if ($_SESSION['connect']) {
        //     $userId = $_SESSION['uid'];

        //     $model = new RentalModel();
        //     $userRecipes = $model->getUserRecipes($userId);

        //     global $router;
            echo self::getRender('dashboard.html.twig', []);
        //}
    }

    public function getOne($id){
        
        echo self::getRender('article.html.twig', []);
    }


}
