<?php

class Rental {
    private $id_rental;
    private $id_user;
    private $title;
    private $content;
    private $capacity;
    private $surface_area;
    private $city;
    private $address;

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
        return $this->id_rental;
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getContent(){
        return $this->content;
    }

    public function getCapacity(){
        return $this->capacity;
    }

    public function getSurface(){
        return $this->surface_area;
    }

    public function getCity(){
        return $this->city;
    }
    
    public function getAddress(){
        return $this->address;
    }



    //SETTERS

    public function setId(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setIdUser(int $id_user){
        $this->id_user=$id_user;
    }

    

    public function setTitle(String $title){
        $this->title=$title;
    }

    public function setContent(String $content){
        $this->content=$content;
    }

    public function setCapacity(int $capacity){
        $this->capacity=$capacity;
    }

    public function setSurface(int $surface_area){
        $this->surface_area = $surface_area;
    }

    public function setCity(String $city){
        $this->city=$city;
    } 

    public function setAddress(String $address){
        $this->address=$address;
    }
}