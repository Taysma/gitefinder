<?php

class User {
    private $id_user;
    private $firstname;
    private $lastname;
    private $mail;
    private $birthdate;
    private $password;
    private $content;
    private $roles;

    public function __construct(array $post){
        $this->hydrate($post);
    }

    private function hydrate(array $post){
        foreach($post as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId(){
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

    

    public function getContent(){
        return $this->content;
    }

    public function getRoles(){
        return $this->roles;
    }

    //SETTERS
    public function setId(int $id_user){
        $this->id_user=$id_user;
    }

    public function setLastname(String $lastname){
        $this->lastname=$lastname;
    }

    public function setFirstname(String $firstname){
        $this->firstname=$firstname;
    }

    public function setBirthdate(String $birthdate){
        $this->birthdate=$birthdate;
    }

    public function setEmail(String $mail){
        $this->mail=$mail;
    }

    public function setPassword(String $password){
        $this->password=$password;
    } 

    public function setContent(String $content){
        $this->content=$content;
    }

    public function setRoles(String $roles){
        $this->roles=$roles;
    }
}