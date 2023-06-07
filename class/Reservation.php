<?php

class Reservation{

    private $id_reservation;
    private $id_user;
    private $id_rental;
    private $available;
    private $checkin_date;
    private $checkout_date;
    private $validation;

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
        return $this->id_reservation;
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function getIdRental(){
        return $this->id_rental;
    }

    public function getAvailable(){
        return $this->available;
    }

    public function getCheckinDate(){
        return $this->checkin_date;
    }

    public function getCheckoutDate(){
        return $this->checkout_date;
    }

    public function getValidation(){
        return $this->validation;
    }



    //SETTERS

    public function setId(int $id_reservation){
        $this->id_reservation=$id_reservation;
    }

    public function setIdUser(int $id_user){
        $this->id_user=$id_user;
    }

    public function setIdRental(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setAvailable(String $available){
        $this->available=$available;
    }

    public function setCheckinDate(String $checkin_date){
        $this->checkin_date=$checkin_date;
    }

    public function setCheckoutDate(String $checkout_date){
        $this->checkout_date=$checkout_date;
    }

    public function setValidation(String $validation){
        $this->validation=$validation;
    }
}