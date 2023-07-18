<?php

class User {
    private $id_user;
    private $firstname;
    private $lastname;
    private $mail;
    private $birthdate;
    private $password;
    private $phone;
    private $content;
    private $roles;

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

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
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

    public function getPhone(){
        return $this->phone;
    } 

    public function getContent(){
        return $this->content;
    }

    public function getRoles(){
        return $this->roles;
    }

    //SETTERS
    public function setId_user(int $id_user){
        $this->id_user=$id_user;
    }

    public function setLastname(String $lastname){
        $this->lastname=$lastname;
    }

    public function setFirstname(String $firstname){
        $this->firstname=$firstname;
    }

    public function setMail(String $mail){
        $this->mail=$mail;
    }

    public function setBirthdate(String $birthdate){
        $this->birthdate=$birthdate;
    } 

    public function setPassword(String $password){
        $this->password=$password;
    } 

    public function setPhone(int $phone){
        $this->phone=$phone;
    } 

    public function setContent($content){
        $this->content=$content;
    }

    public function setRoles($roles){
        $this->roles=$roles;
    }
}