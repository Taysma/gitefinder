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
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {

            echo self::getRender('dashboard.html.twig', []);
        }
    }

    public function getUserProfil(){

        $userModel = new UserModel();
        $personnalData = $userModel->getUserById();
        
        var_dump($personnalData);
        echo self::getRender('profil.html.twig', ['dataP' => $personnalData]);
    }

    public function userProfilUpdate(){

        if (!$_POST) {
            echo self::getRender('homepage.html.twig', []);
        } else {

            global $router;
            $model = new UserModel();
                var_dump($_POST);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $firstname = $_POST['firstname-input'];
                $lastname = $_POST['lastname-input'];
                $mail = $_POST["mail-input"]; // revoir le contrôle du format pour voir si la string est formatée pour un mail
                $phone = $_POST['phone-input'];

                $user = new User([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'mail' => $mail,
                    'phone' => $phone
                ]);

                $model->updateUser($user);
                header('Location: ' . $router->generate('home'));
            } else {
                echo self::getRender('homepage.html.twig', []);
            }
        }
    }

    public function userProfilDelete(){
        
    }

    public function getUserWishlist($id)
    {
        // $wishlistmodel = new WishlistModel();
        // $favoris = $wishlistmodel->getWish($id);

        echo self::getRender('favoris.html.twig', []);
    }

    public function addToWishlist(){}

    public function deleteFromWishlist(){}

    public function getUserMessagerie()
    {
        echo self::getRender('messenger.html.twig', []);
    }

    public function getUserReservation()
    {
        echo self::getRender('rental.html.twig', []);
    }

    public function getUserProperty()
    {
        echo self::getRender('property.html.twig', []);
    }

    public function addProperty()
    {
        if (!$_POST) {
            echo self::getRender('addproperty.html.twig', []);
        } else {

            global $router;
            $model = new RentalModel();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_user = $_SESSION['id_user'];
                $title = $_POST['title'];
                $capacity = $_POST['capacity'];
                $surface_area = $_POST['surface_area'];
                $city = $_POST['city'];
                $address = $_POST['password'];
                $content = $_POST['content'];
                $country = $_POST['country'];
                $price = $_POST['price'];
                // add latitude & longitude later

                $rental = new Rental([
                    'id_user' => $id_user,
                    'title' => $title,
                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'city' => $city,
                    'address' => $address,
                    'content' => $content,
                    'country' => $country,
                    'price' => $price
                ]);

                $model->addRental($rental);
                header('Location: ' . $router->generate('home'));
            } else {
                $message = "Veillez remplir tout les champs";
                echo self::getRender('addproperty.html.twig', ['message' => $message]);
            }
        }
    }
}
