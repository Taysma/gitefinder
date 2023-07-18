<?php
class RentalController extends Controller
{

    public function getOne(int $id_rental){

        global $router;
        $model = new RentalModel();
        $rental = $model->getOneRental($id_rental);
        $oneRental = $router->generate('baseRental');
        echo self::getRender('post.html.twig', ['rental' => $rental, 'oneRental' => $oneRental]);
    }

    public function retrieveLastAdditions()
    {
        $model = new RentalModel();
        $rentals = $model->getAllrentals();

        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    // public function getUserRental()
    // {
    //      if ($_SESSION['connect']) {
    //          $id_user = $_SESSION['id_user'];

    //          $model = new RentalModel();
    //          $userRental = $model->getUserRentals($id_user);

    //          global $router;
    //         echo self::getRender('dashboard.html.twig', ['rental' => $userRental]);
    //     }
    // }

}
