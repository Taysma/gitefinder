<?php

class  Picture{
    private $id_picture;
    private $id_rental;
    private $title;
   

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
    public function getId_picture(){
        return $this->id_picture;
    }

    public function getId_Rental(){
        return $this->id_rental;
    }

    public function getTitle(){
        return $this->title;
    }


    //SETTERS
    public function setId_picture(int $id_picture){
        $this->id_picture = $id_picture;
    }

    public function setId_Rental(int $id_rental){
        $this->id_rental = $id_rental;
    }

    public function setTitle(String $title){
        $this->title = $title;
    }
}