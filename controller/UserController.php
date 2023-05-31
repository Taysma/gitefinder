<?php
class UserController extends Controller {

    public function register(){
        global $router;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

            $user = new User([
                'username' => $username,
                'password' => $password,
                'email' => $email
            ]);

            $model->createUser($user);
            header('Location: ' . $router->generate('login'));
        } else {
            echo self::getRender('registration.html.twig', []);
        }
    }

    public function login(){
        if (!$_POST) {
            echo self::getRender('login.html.twig', []);
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->getUserByEmail($email);

            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['connect'] = true;

                global $router;
                header('Location: ' . $router->generate('dashboardGuest')); // add condition "if" pour les 3 routes si role match host/guest/admin
                exit();
                } else {
                    echo 'ECLATAX';
                }
            } else {
                $message = "Email / password incorrect !";
                echo self::getRender('login.html.twig', ['message' => $message]);
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