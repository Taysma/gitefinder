<?php

class Rental
{
    private $id_rental;
    private $id_user;
    private $title;
    private $content;
    private $cover;
    private $capacity;
    private $surface_area;
    private $address;
    private $price;
    private $latitude;
    private $longitude;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    private function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId_rental()
    {
        return $this->id_rental;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getSurface_area()
    {
        return $this->surface_area;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function getLongitude(){
        return $this->longitude;
    }


    //SETTERS
    public function setId_rental(int $id_rental)
    {
        $this->id_rental = $id_rental;
    }

    public function setId_user(int $id_user)
    {
        $this->id_user = $id_user;
    }

    public function setTitle(String $title)
    {
        $this->title = $title;
    }

    public function setContent(String $content)
    {
        $this->content = $content;
    }

    public function setCover(String $cover)
    {
        $this->cover = $cover;
    }

    public function setCapacity(int $capacity)
    {
        $this->capacity = $capacity;
    }

    public function setSurface_area(String $surface_area)
    {
        $this->surface_area = $surface_area;
    }

    public function setAddress(String $adress){
        $this->address = $adress;
    }

    public function setPrice(int $price){
        $this->price = $price;
    }

    public function setLatitude(String $latitude){
        $this->latitude = $latitude;
    }

    public function setLongitude(String $longitude){
        $this->longitude = $longitude;
    }
}