<?php
class RentalModel extends Model {

    public function getLastTenPost(){
        $recipes = [];

        $req = $this->getDb()->query('SELECT `id`, `author`, `title`, `duration`, `thumbnail`, `content`, `created_at` FROM `recipe` ORDER BY `id` DESC LIMIT 10');

        while($recipe = $req->fetch(PDO::FETCH_ASSOC)){
            $recipes[] = new Recipe($recipe);
        }

        return $recipes;
    }

    public function getAllRecipes(){
        $recipes = [];

        $req = $this->getDb()->query('SELECT `id`, `author`, `title`, `duration`, `thumbnail`, `content`, `created_at` FROM `recipe` ORDER BY `id` DESC');

        while($recipe = $req->fetch(PDO::FETCH_ASSOC)){
            $recipes[] = new Recipe($recipe);
        }

        return $recipes;
    }

    public function getOneRecipe(int $id){

        $req = $this->getDb()->prepare('SELECT `id`, `author`, `title`, `duration`, `thumbnail`, `content`, `created_at` FROM `recipe` WHERE `id`= :id');
        $req->bindParam('id',$id,PDO::PARAM_INT);
        $req->execute();

        $recipe = new Recipe($req->fetch(PDO::FETCH_ASSOC));

        return $recipe;
    }

    public function getUserRecipes(int $userId){
        $recipes = [];

        $req = $this->getDb()->prepare('SELECT `recipe`.`id`, `recipe`.`author`, `recipe`.`title`, `recipe`.`duration`, `recipe`.`thumbnail`, `recipe`.`content`, `recipe`.`created_at`, `user`.`uid`, `user`.`username`, `user`.`email`, `user`.`favoris`, `user`.`joined_date`, `user`.`password`
            FROM `recipe`
            INNER JOIN `user`
            ON `recipe`.`author` = `user`.`uid`
            WHERE `recipe`.`author` = :id');
        $req->bindParam(':id', $userId, PDO::PARAM_INT);
        $req->execute();

        while ($recipeData = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipe($recipeData);
        }

        $req->closeCursor();
        return $recipes;
    }

    public function addRecipe (Recipe $recipe){
        $author = $recipe->getAuthor();
        $title = $recipe->getTitle();
        $duration = $recipe->getDuration();
        $content = $recipe->getContent();

        $req = $this->getDb()->prepare('INSERT INTO `recipe`(`author`, `title`, `duration`, `content`) VALUES (:author, :title, :duration, :content)');

        $req->bindParam('author', $author, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('duration', $duration, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);

        $req->execute();
    }

    public function editRecipe(Recipe $recipe) {
        $id = $recipe->getId();
        $title = $recipe->getTitle();
        $duration = $recipe->getDuration();
        $content = $recipe->getContent();
    
        $req = $this->getDb()->prepare('UPDATE `recipe` SET `title` = :title, `duration` = :duration, `content` = :content WHERE `id` = :id');
    
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('duration', $duration, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
    
        $req->execute();
    }    

    public function deleteRecipe(int $id){
            // Start a new transaction
            $this->getDb()->beginTransaction();
            
            try {
                // Delete links in recipe_category table
                $req = $this->getDb()->prepare('DELETE FROM `recipe_category` WHERE `id_recipe` = :id');
                $req->bindParam('id', $id, PDO::PARAM_INT);
                $req->execute();
        
                // Delete the recipe
                $req = $this->getDb()->prepare('DELETE FROM `recipe` WHERE `id` = :id');
                $req->bindParam('id', $id, PDO::PARAM_INT);
                $req->execute();
        
                // Commit the transaction if both operations succeeded
                $this->getDb()->commit();
        
            } catch(Exception $e) {
                // If any operation fails, an exception is thrown
                // Rollback the transaction
                $this->getDb()->rollBack();
                throw $e;  // or handle it in another way depending on your needs
            }
    }
}