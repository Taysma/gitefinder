<?php
class RentalController extends Controller
{

    public function getOne(int $id_rental)
    {
        global $router;
        $model = new RentalModel();
        $rental = $model->getOneRental($id_rental);
        $oneRental = $router->generate('baseRental');
        echo self::getRender('post.html.twig', ['rental' => $rental, 'oneRental' => $oneRental]);
    }

    public function getOneCategory($id_category)
    {
        $model = new CategoryModel();
        $category = $model->getOneCategory($id_category);
        $rentals = $model->getRentalsByCategory($id_category);

        echo self::getRender('category.html.twig', ['category' => $category, 'rentals' => $rentals]);
    }

    public function retrieveLastAdditions()
    {
        $model = new RentalModel();
        $rentals = $model->getAllrentals();

        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    public function newReservation()
    {
        global $router;

        if (isset($_POST['submit'])) {
            $id_user = $_SESSION['id_user'];
            $id_rental = $_GET['id_rental'];;
            $checkin_date = $_POST['arrivee'];
            $checkout_date = $_POST['depart'];

            $reservation = new Reservation([
                    'id_user' => $id_user,
                    'id_rental' => $id_rental,
                    'checkin_date' => $checkin_date,
                    'checkout_date' => $checkout_date,
                ]);

            var_dump($reservation);

            $model = new ReservationModel();
            $model->addReservation($reservation);

            
            header('Location: ' . $router->generate('baseRental'));

        } else {

            $message = 'Veiller choisir une date de séjour.';
            header('Location: ' . $router->generate('baseRental'));
        }
    }
}
