<?php

class  Review{
    private $id_review;
    private $id_user;
    private $id_rental;
    private $content;
    private $rating;
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
    public function getId_review(){
        return $this->id_review;
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

    public function getRating(){
        return $this->rating;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }


    //SETTERS
    public function setId_review(int $id_review){
        $this->id_review = $id_review;
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

    public function setRating(int $rating){
        $this->rating = $rating;
    }

    public function setCreated_at(String $created_at){
        $this->created_at = $created_at;
    }
}