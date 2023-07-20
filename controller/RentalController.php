<?php
class RentalController extends Controller
{

    public function addProperty(){
        if (!$_POST) {
            echo self::getRender('dashboard.html.twig', []);
        } else {

            global $router;
            $model = new RentalModel();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $content= $_POST['content'];
                $cover = $_POST['cover'];
                $capacity = $_POST['capacity'];
                $surface_area = $_POST['surface_area'];
                $city = $_POST['city'];
                $address = $_POST['address'];
                $country = $_POST['country'];
                $price = $_POST['price'];
               

                $rental = new Rental([
                    'title' => $title,
                    'content' => $content,
                    'cover' => $cover,
                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'city' => $city,
                    'address' => $address,
                    'country' => $country,
                    'price' => $price
                    

                ]);

                $model->addRental($rental);
                header('Location: ' . $router->generate('home'));
            } else {
                echo self::getRender('dashboard.html.twig', []);
            }
        }
    }
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
