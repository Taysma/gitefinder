<?php
class UserController extends Controller
{

    // Connection utilisateur
    public function register()
    {
        if (!$_POST) {
            echo self::getRender('register.html.twig', []);
        } else {

            global $router;
            $model = new UserModel();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
                $birthdate = $_POST['birthdate'];
                $rawPass = $_POST['password'];
                $password = password_hash($rawPass, PASSWORD_DEFAULT);

                $user = new User([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'mail' => $mail,
                    'birthdate' => $birthdate,
                    'password' => $password,

                ]);

                $model->createUser($user);
                header('Location: ' . $router->generate('home'));
            } else {
                echo self::getRender('connect.html.twig', []);
            }
        }
    }

    public function login()
    {
        if (!$_POST) {
            echo self::getRender('connect.html.twig', []);
        } else {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->getUserByEmail($mail);

            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id_user'] = $user->getId_user();
                    $_SESSION['firstname'] = $user->getFirstname();
                    $_SESSION['connect'] = true;

                global $router;
                header('Location: ' . $router->generate('dashboard')); // add condition "if" pour les 3 routes si role match host/guest/admin
                exit();
                } else {
                    echo 'Email / password incorrect !';
                }
            } else {
                $message = "Veillez remplir tout les champs";
                echo self::getRender('connect.html.twig', ['message' => $message]);
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        global $router;
        header('Location: ' . $router->generate('home'));
        exit();
    }

    // Dashboard
    public function getUserDashboard()
    {
        echo self::getRender('dashboard.html.twig', []);
    }

    public function getUserProfil()
    {
        echo self::getRender('profil.html.twig', []);
    }

    public function getUserFavoris(){
        $wishlistmodel = new WishlistModel();
        $favoris = $wishlistmodel->getAllWishlist();
        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();
        
        var_dump($rentals);

        echo self::getRender('favoris.html.twig', ['wishlist' => $favoris, 'rentals' => $rentals]);
    }

    public function getUserReservation()
    {
        echo self::getRender('rental.html.twig', []);
    }

    public function getUserRental()
    {
        echo self::getRender('', []);
    }
}
