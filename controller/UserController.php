<?php
class UserController extends Controller {

    public function register(){
        global $router;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
            $birthdate = $_POST['birthdate'];
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $content = $_POST['content'];
            $roles = $_POST['roles'];
            

            $user = new User([
                'id_user' => $id_user,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'birthdate' => $birthdate,
                'password' => $password,
                'content' => $content,
                'roles' => $roles
                
            ]);

            $model->createUser($user);
            header('Location: ' . $router->generate('login'));
        } else {
            echo self::getRender('connect.html.twig', []);
        }
    }

    public function login(){
        if (!$_POST) {
            echo self::getRender('connect.html.twig', []);
        } else {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->getUserByEmail($mail);

            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId_user();
                    $_SESSION['firstname'] = $user->getFirstname();
                    $_SESSION['connect'] = true;

                global $router;
                header('Location: ' . $router->generate('dashboardUser')); // add condition "if" pour les 3 routes si role match host/guest/admin
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

    public function logout(){
        session_start();
        session_destroy();

        global $router;
        header('Location: ' . $router->generate('home'));
        exit();
    }
}