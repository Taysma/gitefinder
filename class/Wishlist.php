<?php

class  Wishlist{
    private $id_wishlist;
    private $id_user;
    private $id_rental;
    

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
    public function getId_wishlist(){
        return $this->id_wishlist;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function getId_rental(){
        return $this->id_rental;
    }


    //SETTERS

    public function setId_wishlist(int $id_wishlist){
        $this->id_wishlist = $id_wishlist;
    }

    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }

    public function setId_rental(int $id_rental){
        $this->id_rental = $id_rental;
    }

}

