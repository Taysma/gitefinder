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

    public function addProperty()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            if (isset($_FILES['title']) ) {
                $id_user = $_SESSION['id_user'];
                global $router;
                $model = new RentalModel();
                $Pmodel = new PictureModel();
    
    
                $title = $_POST['title'];
                $content = $_POST['content'];
                // $cover = $_POST['cover'];
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
                    // 'cover' => $cover,
                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'address' => $address,
                    'price' => $price,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                ]);
    
                $insertEtRecupId = $model->addRental($id_user, $rental);
                var_dump($selectedCategories);
                foreach ($selectedCategories as $id_category) {
                    $model->addRentalCategory($insertEtRecupId, $id_category);
                }

    
                if ($insertEtRecupId) {
                    $uploadTitleImg = 'asset/media/images/';
                    
                    foreach ($titlePictures as $index => $titlePicture) {
                        $uploadTitleFile = $uploadTitleImg . $titlePicture;
                        $controleTitleUpload = move_uploaded_file($_FILES['title']['tmp_name'][$index], $uploadTitleFile);
    
                        if (!$controleTitleUpload) {
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
                }
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
                    $_SESSION['avatar'] = $user->getAvatar();
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

    public function getUserProfil()
    {
        $userModel = new UserModel();
        $personnalData = $userModel->getUserById();

        echo self::getRender('profil.html.twig', ['dataP' => $personnalData]);
    }

    public function editProfil()
    {

        global $router;
        $model = new UserModel();
        //var_dump($_POST);
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
        //var_dump($_POST);
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
        $model = new ReservationModel();
        $reservations = $model->getAllUserReservation();

        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();

        echo self::getRender('rental.html.twig', ['reservations' => $reservations, 'rentals' => $rentals]);
    }

    //Dashboard - CRUD Wishlist User
    public function getUserWishlist()
    {
        $model = new WishlistModel();
        $wishlist = $model->getWish();

        $rentalModel = new RentalModel();
        $rentals = $rentalModel->getAllRentals();

        echo self::getRender('favoris.html.twig', ['wishlist' => $wishlist, 'rentals' => $rentals]);
    }

    public function addToWishlist()
    {
    }

    public function deleteFromWishlist()
    {
    }

    //Dashboard - CRUD Messagerie User
    public function getUserMessagerie()
    {
        echo self::getRender('messenger.html.twig', []);
    }

    //Dashboard - CRUD Propriétés User
    public function getUserProperty()
    {
        $id_user = $_SESSION['id_user'];

        $model = new RentalModel();
        $CategoryModel = new CategoryModel();
        $rentalsUser = $model->getUserRentals($id_user);
        $categories = $CategoryModel->getAllCategory();


        echo self::getRender('addproperty.html.twig', ['rentals' => $rentalsUser, 'categories' => $categories]);



    }

    public function editProperty()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            if (isset($_FILES['title']) ) {
                $id_user = $_SESSION['id_user'];
                global $router;
                $model = new RentalModel();
                $Pmodel = new PictureModel();
    
    
                $title = $_POST['title'];
                $content = $_POST['content'];
                // $cover = $_POST['cover'];
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
                    // 'cover' => $cover,
                    'capacity' => $capacity,
                    'surface_area' => $surface_area,
                    'address' => $address,
                    'price' => $price,
                    'latitude' => $latitude,
                    'longitude' => $longitude
                ]);
    
                $model->updateRental($id_user, $rental);
                var_dump($selectedCategories);
                foreach ($selectedCategories as $id_category) {
                    $model->addRentalCategory($insertEtRecupId, $id_category);
                }

    
                if ($insertEtRecupId) {
                    $uploadTitleImg = 'asset/media/images/';
                    
                    foreach ($titlePictures as $index => $titlePicture) {
                        $uploadTitleFile = $uploadTitleImg . $titlePicture;
                        $controleTitleUpload = move_uploaded_file($_FILES['title']['tmp_name'][$index], $uploadTitleFile);
    
                        if (!$controleTitleUpload) {
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
                }
            }
        }
        
    }


}