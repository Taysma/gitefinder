<?php

class User {
    private $id_user;
    private $username;
    private $mail;
    private $birthdate;
    private $password;
    private $role;
    private $content;

    public function __construct(array $datas){
        $this->hydrate($datas);
    }

    private function hydrate(array $datas){
        foreach($datas as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId_user(){
        return $this->id_user;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRole(){
        return $this->role;
    }

    public function getContent(){
        return $this->content;
    }

    //SETTERS
    public function setId(int $id_user){
        $this->id_user=$id_user;
    }

    public function setUsername(String $username){
        $this->username=$username;
    }

    public function setMail(int $mail){
        $this->mail=$mail;
    }

    public function setBirthdate(String $birthdate){
        $this->birthdate=$birthdate;
    }

    public function setPassword(String $password){
        $this->password=$password;
    }

    public function setRole(String $role){
        $this->role=$role;
    }

    public function setContent(String $content){
        $this->content=$content;
    }
}