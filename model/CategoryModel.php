<?php
class CategoryModel extends Model {
    
    public function getAllCategory(){
        $categories = [];

        $req = $this->getDb()->query('SELECT `cid`, `cname`, `cslug` FROM `category`');

        while($category = $req->fetch(PDO::FETCH_ASSOC)){
            $categories[] = new Category($category);
        }
        return $categories;
    }

    public function getOneCategory(int $id){

        $req = $this->getDb()->prepare('SELECT `cid`, `cname`, `cslug` FROM `category` WHERE `cid` = :id');
        $req->bindParam('id',$id,PDO::PARAM_INT);
        $req->execute();

        $category = new Category($req->fetch(PDO::FETCH_ASSOC));

        return $category;
    }
    
    public function getRecipesByCategory(int $categoryId) {
        $recipes = [];

        $req = $this->getDb()->prepare('SELECT `recipe`.`id`, `recipe`.`author`, `recipe`.`title`, `recipe`.`duration`, `recipe`.`thumbnail`, `recipe`.`content`, `recipe`.`created_at`
            FROM `recipe`
            INNER JOIN `recipe_category`
            ON `recipe_category`.`id_recipe` = `recipe`.`id`
            INNER JOIN `category`
            ON `recipe_category`.`id_category` = `category`.`cid`
            WHERE `category`.`cid` = :categoryId');
        $req->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $req->execute();

        while ($recipeData = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipe($recipeData);
        }

        return $recipes;
    }
}