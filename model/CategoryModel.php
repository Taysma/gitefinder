<?php
class CategoryModel extends Model {
    
    public function getAllCategory(){
        $categories = [];

        $req = $this->getDb()->query('SELECT `id_category`, `tag`, `name`, `slug` FROM `category`');

        while($category = $req->fetch(PDO::FETCH_ASSOC)){
            $categories[] = new Category($category);
        }
        return $categories;
    }

    public function getOneCategory(int $id_category){

        $req = $this->getDb()->prepare('SELECT `id_category`, `tag`, `name`, `slug` FROM `category` WHERE `id_category` = :id_category');
        $req->bindParam('id_category',$id_category,PDO::PARAM_INT);
        $req->execute();

        $category = new Category($req->fetch(PDO::FETCH_ASSOC));

        return $category;
    }
    
    public function getrentalsByCategory(int $id_category) {
        $rentals = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content` 
            FROM `rental`
            INNER JOIN `rental_category`
            ON `rental_category`.`id_rental` = `rental`.`id_rental`
            INNER JOIN `category`
            ON `rental_category`.`id_category` = `category`.`id_category`
            WHERE `category`.`id_category` = :id_category');
        $req->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $req->execute();

        while ($rentalData = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Category($rentalData);
        }

        return $rentals;
    }
}