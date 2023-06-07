<?php 

class Rental{
    private $id_rental;
    private $id_user;
    private $title;
    private $capacity;
    private $surface_area;
    private $city;
    private $adress;
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
    public function getId_rental(){
        return $this->id_rental;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getCapacity(){
        return $this->capacity;
    }

    public function getSurface_area(){
        return $this->surface_area;
    }

    public function getCity(){
        return $this->city;
    }

    public function getAdress(){
        return $this->adress;
    }

    public function getContent(){
        return $this->content;
    }


    //SETTERS
    public function setId_rental(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setId_user(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setTitle(String $title){
        $this->title=$title;
    }

    public function setCapacity(int $capacity){
        $this->capacity=$capacity;
    }

    public function setSurface_area(int $surface_area){
        $this->surface_area=$surface_area;
    }

    public function setCity(int $city){
        $this->city=$city;
    }

    public function setAdress(int $adress){
        $this->adress=$adress;
    }

    public function setContent(int $content){
        $this->content=$content;
    }

}