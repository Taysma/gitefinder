<?php
class CategoryModel extends Model
{


   
    public function getAllCategory() //partie category formulaire d'ajout
    {
        $categories = [];

        $req = $this->getDb()->query('SELECT `id_category`, `tag`, `name`, `slug` FROM `category` ORDER BY `id_category` ASC');

        while ($category = $req->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($category);
        }
        
        return $categories;
    }

    public function getOneCategory(int $id_category)
    {
        $req = $this->getDb()->prepare('SELECT `id_category`, `tag`, `name`, `slug` FROM `category` WHERE `id_category` = :id_category');
        $req->bindParam('id_category', $id_category, PDO::PARAM_INT);
        $req->execute();

        $category = new Category($req->fetch(PDO::FETCH_ASSOC));

        return $category;
    }
    
    public function getRentalsByCategory(int $id_category) 
    {
        $rentals = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`cover`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`address`, `rental`.`content`, `rental`.`price` 
        FROM `rental` 
        INNER JOIN `rental_category` 
        ON `rental_category`.`id_rental` = `rental`.`id_rental` 
        INNER JOIN `category` 
        ON `rental_category`.`id_category` = `category`.`id_category` 
        WHERE `category`.`id_category` = :id_category');
        $req->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $req->execute();

        while ($rental = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }

}