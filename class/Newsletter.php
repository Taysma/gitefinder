<?php

class  Newsletter{
    private $id_newsletter;
    private $mail;
    

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
    public function getId_newsletter(){
        return $this->id_newsletter;
    }

    public function getMail(){
        return $this->mail;
    }


    //SETTERS
    public function setId_newsletter(int $id_newsletter){
        $this->id_newsletter = $id_newsletter;
    }

    public function setMail(String $mail){
        $this->mail = $mail;
    }
}