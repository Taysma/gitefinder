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

    public function retrieveLastAdditions()
    {
        $model = new RentalModel();
        $rentals = $model->getAllrentals();

        echo self::getRender('homePage.html.twig', ['rentals' => $rentals]);
    }

    public function newReservation($id_rental)
    {
        

        global $router;
        if (!$_POST) {
            echo self::getRender('post.html.twig', []);
        } else {
            if (isset($_POST['submit'])) {
                $id_rental = $_GET['id_rental'];
                $id_user = $_SESSION['id_user'];
                $title = $_POST['title'];
                $duration = $_POST['duration'];
                $content = $_POST['content'];
                $author = $_SESSION['uid'];

                $reservation = new Reservation([

                    'title' => $title,
                    'duration' => $duration,
                    'content' => $content,
                    'author' => $author,
                ]);
                
                $model = new ReservationModel();
                $model->addReservation($reservation);

                header('Location: ' . $router->generate('reserver'));
            } else {
                echo '<script>window.location.reload();</script>';
                $message = 'Oops, something went wrong sorry. Try again later';
            }
        }
    }
}
