<?php

class Category {
    private $id_category;
    private $tag;
    private $name;
    private $slug;
    

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
        return $this->id_category;
    }

    public function getTag(){
        return $this->tag;
    }

    public function getName(){
        return $this->name;
    }

    public function getSlug(){
        return $this->slug;
    }



    //SETTERS

    public function setId(int $id_category){
        $this->id_category=$id_category;
    }

    public function setTag(String $tag){
        $this->tag=$tag;
    }

    

    public function setName(String $name){
        $this->name=$name;
    }

    public function setSlug(String $slug){
        $this->slug=$slug;
    }

   
}