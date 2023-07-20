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
    public function getId_chat(){
        return $this->id_chat;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function getId_rental(){
        return $this->id_rental;
    }

    public function getContent(){
        return $this->content;
    }

    public function getSend_at(){
        return $this->send_at;
    }


    //SETTERS
    public function setId_chat(int $id_chat){
        $this->id_chat = $id_chat;
    }

    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }

    public function setId_rental(int $id_rental){
        $this->id_rental = $id_rental;
    }

    public function setContent(String $content){
        $this->content = $content;
    }

    public function setSend_at(String $send_at){
        $this->send_at = $send_at;
    }

}