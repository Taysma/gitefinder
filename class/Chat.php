<?php

class Chat {
    private $id_chat;
    private $id_user;
    private $id_rental;
    private $content;
    private $send_at;
    
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
        return $this->id_chat;
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function getIdRental(){
        return $this->id_rental;
    }

    public function getContent(){
        return $this->content;
    }

    public function getSendAt(){
        return $this->send_at;
    }



    //SETTERS

    public function setId(int $id_chat){
        $this->id_chat=$id_chat;
    }

    public function setIdUser(int $id_user){
        $this->id_user=$id_user;
    }

    public function setIdRental(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setContent(String $content){
        $this->content=$content;
    }

    public function setSendAt(String $send_at){
        $this->send_at=$send_at;
    }

}