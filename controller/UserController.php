<?php
class UserController extends Controller
{
    // Connection utilisateur
    public function register()
    {
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

            header('Location: ' . $router->generate('dashboard'));
            exit();
        } else {
            echo self::getRender('register.html.twig', []);
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
                    $_SESSION['avatar'] = $user->getAvatar();
                    $_SESSION['connect'] = true;

                    global $router;
                    header('Location: ' . $router->generate('dashboard'));
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

    public function getUserProfil()
    {
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {
            $userModel = new UserModel();
            $personnalData = $userModel->getUserById();

            echo self::getRender('profil.html.twig', ['dataP' => $personnalData]);
        }
    }

    public function editProfil()
    {
        global $router;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $mail = $_POST["mail"]; // revoir le contrôle du format pour voir si la string est formatée pour un mail
            $phone = $_POST['phone'];

            $user = new User([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'phone' => $phone
            ]);

            $model->updateUser($user);
            header('Location: ' . $router->generate('userProfil'));
        } else {
            echo self::getRender('profil.html.twig', []);
        }
    }

    public function editAvatar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                global $router;
                $model = new UserModel();
                $avatar = $_FILES['avatar']['name'];

                $queryAvatar = $model->modelAvatar($_SESSION['id_user'], $avatar);

                if ($queryAvatar) {
                    $uploadImg = 'asset/media/images/';
                    $uploadFile = $uploadImg . $_FILES['avatar']['name'];
                    $controleUpload = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);

                    if (!$controleUpload) {
                        header('Location: ' . $router->generate('uploadError'));
                        exit;
                    }

                    $_SESSION['avatar'] = $avatar;

                    header('Location: ' . $router->generate('userProfil'));

                    exit;
                }
            }
        } else {

            echo self::getRender('profil.html.twig', []);
        }
    }

    public function deleteProfil()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            global $router;
            $model = new UserModel();

            $id_user = $_SESSION['id_user'];

            $model->deleteUser($id_user);
            session_destroy();
            $_SESSION = [];
            header('Location: ' . $router->generate('home'));
        } else {
            echo self::getRender('connect.html.twig', []);
        }
    }

    //Dashboard - CRUD Propriétés User
    public function getUserProperty()
    {
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {
            $id_user = $_SESSION['id_user'];

            $model = new RentalModel();
            $CategoryModel = new CategoryModel();
            $rentalsUser = $model->getUserRentals($id_user);
            $categories = $CategoryModel->getAllCategory();

            echo self::getRender('property.html.twig', ['rentals' => $rentalsUser, 'categories' => $categories]);
        }
    }

    public function addProperty()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (null !== $_FILES['cover']) {
                $id_user = $_SESSION['id_user'];
                global $router;
                $model = new RentalModel();
                $Pmodel = new PictureModel();


                $title = $_POST['title'];
                $content = $_POST['content'];
                $cover = $_FILES['cover']['name'];
                $capacity = $_POST['capacity'];
                $surface_area = $_POST['surface_area'];
                $address = $_POST['address'];
                $price = intval($_POST['price']);
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $selectedCategories = $_POST['categories'];
                $titlePictures = $_FILES['title']['name'];

                $rental = new Rental([
                    'id_user' => $id_user,
                    'title' => $title,
                    'content' => $content,
                    'cover' => $cover,
                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'address' => $address,
                    'price' => $price,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                ]);


                $insertEtRecupId = $model->addRental($id_user, $rental);

                foreach ($selectedCategories as $id_category) {
                    $model->addRentalCategory($insertEtRecupId, $id_category);
                }


                if ($insertEtRecupId) {
                    $uploadTitleImg = 'asset/media/images/';

                    $uploadImg = 'asset/media/images/';
                    $uploadFile = $uploadImg . $_FILES['cover']['name'];
                    $controleUpload = move_uploaded_file($_FILES['cover']['tmp_name'], $uploadFile);

                    foreach ($titlePictures as $index => $titlePicture) {
                        $uploadTitleFile = $uploadTitleImg . $titlePicture;
                        $controleTitleUpload = move_uploaded_file($_FILES['title']['tmp_name'][$index], $uploadTitleFile);

                        if (!$controleUpload || !$controleTitleUpload) {
                            // Gérer l'échec du téléchargement
                        }

                        $picture = new Picture([
                            'id_rental' => $insertEtRecupId,
                            'title' => $titlePicture
                        ]);

                        $picture = $Pmodel->addPicture($picture);
                    }


                    $picturesString = "";
                    foreach ($titlePictures as $titlePicture) {
                        $picturesString .= "Image Title: $titlePicture\n";
                    }

                    header('Location: ' . $router->generate('userProperty'));
                    exit;
                }
            } else {
                $message = "Les informations n'a pas pu être enregister.";
                echo self::getRender('property.html.twig', ['message' => $message]);
            }
        }
    }

    public function editProperty()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_FILES['title'])) {
                $id_user = $_SESSION['id_user'];
                global $router;
                $model = new RentalModel();
                $Pmodel = new PictureModel();

                $id_rental = $_GET['id_rental'];
                $title = $_POST['title'];
                $content = $_POST['content'];

                $capacity = $_POST['capacity'];
                $surface_area = $_POST['surface_area'];
                $address = $_POST['address'];
                $price = intval($_POST['price']);
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $selectedCategories = $_POST['categories'];
                $titlePictures = $_FILES['title']['name'];

                $rental = new Rental([

                    'title' => $title,
                    'content' => $content,

                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'address' => $address,
                    'price' => $price,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                ]);

                $model->updateRental($rental);

                foreach ($selectedCategories as $id_category) {
                    $model->updateRentalCategory($id_rental, $id_category);
                }


                if ($id_rental) {
                    $uploadTitleImg = 'asset/media/images/';

                    foreach ($titlePictures as $index => $titlePicture) {
                        $uploadTitleFile = $uploadTitleImg . $titlePicture;
                        $controleTitleUpload = move_uploaded_file($_FILES['title']['tmp_name'][$index], $uploadTitleFile);

                        if (!$controleTitleUpload) {
                            // Gérer l'échec du téléchargement
                        }

                        $picture = new Picture([
                            'id_rental' => $id_rental,
                            'title' => $titlePicture
                        ]);

                        $picture = $Pmodel->addPicture($picture);
                    }


                    $picturesString = "";
                    foreach ($titlePictures as $titlePicture) {
                        $picturesString .= "Image Title: $titlePicture\n";
                    }

                    header('Location: ' . $router->generate('userProperty'));
                }
            }
        }
    }

    public function deleteProperty()
    {
        global $router;
        $model = new RentalModel();

        $id = $_POST['id_rental'];

        $model->deleteRental($id);

        header('Location: ' . $router->generate('userProperty'));
    }

    //Dashboard - CRUD Reservation User
    public function getUserReservation()
    {
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {
            $model = new ReservationModel();
            $reservations = $model->getAllUserReservation();

            $rentalModel = new RentalModel();
            $rentals = $rentalModel->getAllRentals();

            echo self::getRender('rental.html.twig', ['reservations' => $reservations, 'rentals' => $rentals]);
        }
    }

    public function deleteReservation()
    {
        global $router;
        $id_user = $_SESSION['id_user'];
        $id_rental = $_POST['id_rental'];

        $model = new RentalModel();
        $model->deleteUserReservation($id_user, $id_rental);

        header('Location:' . $router->generate('userReservations'));
        exit();

    }

    //Dashboard - CRUD Wishlist User
    public function getUserWishlist()
    {
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {
            $model = new WishlistModel();
            $wishlist = $model->getWish();

            $rentalModel = new RentalModel();
            $rentals = $rentalModel->getAllRentals();

            echo self::getRender('favoris.html.twig', ['wishlist' => $wishlist, 'rentals' => $rentals]);
        }
    }

    public function addToWishlist(int $id_rental)
    {
        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {

            $id_user = $_SESSION['id_user'];

            global $router;
            $model = new RentalModel();
            $model->getOneRental($id_rental);

            $favorite = new Wishlist(['id_user' => $id_user, 'id_rental' => $id_rental]);

            $favoriteModel = new WishlistModel();
            $favoriteModel->addWish($favorite, $id_rental);

            header('Location:' . $router->generate('home'));
            exit();
        } else {
            $message = "Veillez vous connecter pour ajouter des favoris";
            echo self::getRender('connect.html.twig', ['message' => $message]);
        }
    }

    public function deleteFromWishlist(int $id_rental)
    {
        global $router;
        $id_user = $_SESSION['id_user'];

        $model = new WishlistModel();
        $model->deleteWish($id_user, $id_rental);

        header('Location:' . $router->generate('home'));
        exit();
    }

    //Dashboard - CRUD Messagerie User
    public function getUserMessagerie()
    {
        if (!isset($_SESSION['connect']) || $_SESSION['connect'] !== true) {
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        } else {
            echo self::getRender('messenger.html.twig', []);
        }
    }
}