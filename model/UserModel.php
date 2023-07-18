<?php
class UserModel extends Model
{

    public function createUser($user)
    {

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $mail = $user->getMail();
        $birthdate = $user->getBirthdate();
        $password = $user->getPassword();
        $phone = $user->getPhone();




        $req = $this->getDb()->prepare("INSERT INTO `user` ( `firstname`, `lastname`, `mail`, `birthdate`, `password` ) VALUES (:firstname, :lastname, :mail, :birthdate, :password )");
        $req->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $req->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $req->bindParam(":password", $password, PDO::PARAM_STR);




        $req->execute();


    }

    public function getUserByEmail(string $mail)
    {
        $req = $this->getDb()->prepare("SELECT `id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `content`, `roles` FROM `user` WHERE `mail` = :mail");
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();

        return $req->rowCount() === 1 ? new User($req->fetch(PDO::FETCH_ASSOC)) : false;
    }

    public function getAllUsers()
    {
        $users = [];

        $req = $this->getDb()->query('SELECT `id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `phone`, `content`, `roles` FROM `user`');

        while ($user = $req->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($user);
        }


        return $users;
    }

    public function getUserById()
    {
        $id_user = $_SESSION['id_user'];
        $req = $this->getDb()->prepare('SELECT `id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `phone`,`content`, `roles` FROM `user` WHERE `id_user` = :id');
        $req->bindParam('id', $id_user, PDO::PARAM_INT);
        $req->execute();

        $user = new User($req->fetch(PDO::FETCH_ASSOC));

        return $user;
    }

    public function updateUser()
    {

        $id_user = $_SESSION['id_user'];

        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $mail = $_SESSION['mail'];
        $birthdate = $_SESSION['birthdate'];
        $password = $_SESSION['password'];
        $phone = $_SESSION['phone'];
        $content = $_SESSION['content'];
        $roles = $_SESSION['roles'];

        


        $req = $this->getDb()->prepare("UPDATE `user` SET `id_user`=:id_user,`firstname`=:firstname,`lastname`=:lastname,`mail`=:mail,`birthdate`=:birthdate,`password`=:password, `phone`=:phone,`content`=:content,`roles`=:roles ");

        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $req->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":phone", $phone, PDO::PARAM_INT);
        $req->bindParam(":content", $content, PDO::PARAM_STR);
        $req->bindParam(":roles", $roles, PDO::PARAM_STR);


        $req->execute();

        // return $user;
    }

    public function deleteUser(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {
            // Delete links in chat table
            $req = $this->getDb()->prepare('DELETE FROM `chat` WHERE `id_user` = :id_user');
            $req->bindParam('id_user', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete links in rental table
            $req = $this->getDb()->prepare('DELETE FROM `rental` WHERE `id_user` = :id_user');
            $req->bindParam('id_user', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete links in reservation table
            $req = $this->getDb()->prepare('DELETE FROM `reservation` WHERE `id_user` = :id_user');
            $req->bindParam('id_user', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete links in review table
            $req = $this->getDb()->prepare('DELETE FROM `review` WHERE `id_user` = :id_user');
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete links in wishlist table
            $req = $this->getDb()->prepare('DELETE FROM `wishlist` WHERE `id_user` = :id_user');
            $req->bindParam('id_user', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete the user
            $req = $this->getDb()->prepare('DELETE FROM `user` WHERE `id_user` = :id_user');
            $req->bindParam('id_user', $id, PDO::PARAM_INT);
            $req->execute();

            // Commit the transaction if both operations succeeded
            $this->getDb()->commit();

        } catch (Exception $e) {
            // If any operation fails, an exception is thrown
            // Rollback the transaction
            $this->getDb()->rollBack();
            throw $e; // or handle it in another way depending on your needs
        }
    }



}