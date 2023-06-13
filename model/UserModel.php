<?php
class UserModel extends Model {

    public function createUser (User $user){
        $id_user = $user->getId_user();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $mail = $user->getMail();
        $birthdate = $user->getBirthdate();
        $password = $user->getPassword();
        $content = $user->getContent();
        $roles = $user->getRoles();
        
        

        $req = $this->getDb()->prepare("INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `content`, `roles`) VALUES (:id_user, :firstname, :lastname, :mail, :birthdate, :password, :content, :roles)");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $req->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":content", $content, PDO::PARAM_STR);
        $req->bindParam(":roles", $roles, PDO::PARAM_STR);
        

        $req->execute();

        
    }

    public function getUserByEmail(string $mail){
        $req = $this->getDb()->prepare("SELECT `id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `content`, `roles` FROM `user` WHERE `mail` = :mail");
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();

        return $req->rowCount() === 1 ? new User($req->fetch(PDO::FETCH_ASSOC)) : false;
    }

    public function getAllUsers(){
        $users = [];

        $req = $this->getDb()->query('SELECT `id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `content`, `roles` FROM `user`');

        while ($user = $req->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($user);
        }

        
        return $users;
    }


    public function updateUser(User $user){
        $id_user = $user->getId_user();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $mail = $user->getMail();
        $birthdate = $user->getBirthdate();
        $password = $user->getPassword();
        $content = $user->getContent();
        $roles = $user->getRoles();
        
        

        $req = $this->getDb()->prepare("UPDATE `user` SET `id_user`=':id_user',`firstname`=':firstname',`lastname`=':lastname',`mail`=':mail',`birthdate`=':birthdate',`password`=':password',`content`=':content',`roles`=':roles' ");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $req->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":content", $content, PDO::PARAM_STR);
        $req->bindParam(":roles", $roles, PDO::PARAM_STR);
        

        $req->execute();

        
    }
}