<?php
class RentalController extends Controller
{
    public function getOne(int $id_rental)
    {
        global $router;
        $model = new RentalModel();
        $modelPicture = new PictureModel();
        $rental = $model->getOneRental($id_rental);

        $picture = $modelPicture->getAllPicture($id_rental);

        $oneRental = $router->generate('baseRental');
        echo self::getRender('post.html.twig', ['rental' => $rental, 'oneRental' => $oneRental, 'picture' => $picture]);
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
        $model = new ReservationModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['id_user'];
            $id_rental = $_POST['id_post'];
            $checkin_date = $_POST['arrivee'];
            $checkout_date = $_POST['depart'];
            $numb_guest = $_POST['personnes'];

            $checkin = new DateTime($checkin_date);
            $checkout = new DateTime($checkout_date);
            $interval = $checkin->diff($checkout);

            $total_price = (($_POST['price'] * $interval->days) + (($_POST['price'] * $interval->days) * 0.05));

            $reservation = new Reservation([
                'id_user' => $id_user,
                'id_rental' => $id_rental,
                'checkin_date' => $checkin_date,
                'checkout_date' => $checkout_date,
                'num_guest' => $numb_guest,
                'total_price' => $total_price,
            ]);

            $model->addReservation($reservation);
            header('Location: ' . $router->generate('userReservations'));
        } else {

            $message = 'Veiller choisir une date de séjour.';
            header('Location: ' . $router->generate('baseRental'));
        }
    }
}
