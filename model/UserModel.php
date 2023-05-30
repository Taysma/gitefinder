<?php
class UserModel extends Model {

    public function createUser(User $user){
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();

        $req = $this->getDb()->prepare("INSERT INTO `user` (`username`, `password`, `email`) VALUES (:password, :username, :email)");
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":username", $username, PDO::PARAM_STR);
        $req->bindParam(":email", $email, PDO::PARAM_STR);

        $req->execute();

        $req->closeCursor();
    }

    public function getUserByEmail(string $email){
        $req = $this->getDb()->prepare("SELECT `id`, `username`, `password`, `email`, `joined_date` FROM `user` WHERE `email` = :email");
        $req->bindParam(":email", $email, PDO::PARAM_STR);
        $req->execute();

        return $req->rowCount() === 1 ? new User($req->fetch(PDO::FETCH_ASSOC)) : false;
    }
}