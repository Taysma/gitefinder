<?php

class Reservation{
    private $id_reservation;
    private $id_user;
    private $id_rental;
    private $status;
    private $checkin_date;
    private $checkout_date;
    private $num_guest;
    private $total_price;
    private $created_at;


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
    public function getId_reservation(){
        return $this->id_reservation;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function getId_rental(){
        return $this->id_rental;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getCheckin_date(){
        return $this->checkin_date;
    }

    public function getCheckout_date(){
        return $this->checkout_date;
    }

    public function getNum_guest(){
        return $this->num_guest;
    }
    
    public function getTotal_price(){
        return $this->total_price;
    }

    public function getCreated_at(){
        return $this->created_at;
    }


    //SETTERS
    public function setId_reservation(int $id_reservation){
        $this->id_reservation = $id_reservation;
    }

    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }

    public function setId_rental(int $id_rental){
        $this->id_rental = $id_rental;
    }

    public function setStatus(bool $status){
        $this->status = $status;
    }

    public function setCheckin_date(String $checkin_date){
        $this->checkin_date = $checkin_date;
    }

    public function setCheckout_date(String $checkout_date){
        $this->checkout_date = $checkout_date;
    }

    public function setNum_guest(String $num_guest){
        $this->num_guest = $num_guest;
    }
    
    public function setTotal_price(int $total_price){
        $this->total_price = $total_price;
    }

    public function setCreated_at(String $created_at){
        $this->created_at = $created_at;
    }
}