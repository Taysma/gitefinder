<?php
class CategoryModel extends Model
{

    public function createCategory(Category $category)
    {
        $id_category = $category->getId_category();
        $tag = $category->getTag();
        $name = $category->getName();
        $slug = $category->getSlug();




        $req = $this->getDb()->prepare("INSERT INTO `category` (`id_category`, `tag`, `name`, `slug`) VALUES (:id_category, :tag, :name, :slug)");
        $req->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $req->bindParam(":tag", $tag, PDO::PARAM_STR);
        $req->bindParam(":name", $name, PDO::PARAM_STR);
        $req->bindParam(":slug", $slug, PDO::PARAM_STR);



        $req->execute();


    }

    public function getAllCategory()
    {
        $categories = [];

        $req = $this->getDb()->query('SELECT `id_category`, `tag`, `name`, `slug` FROM `category`');

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

    public function getrentalsByCategory(int $id_category)
    {
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


    public function update(Category $category)
    {
        $id_category = $category->getId_category();
        $tag = $category->getTag();
        $name = $category->getName();
        $slug = $category->getSlug();


        $req = $this->getDb()->prepare("UPDATE `category` SET `id_category`=':id_category',`tag`=':tag',`name`=':name',`slug`=':slug' ");
        $req->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $req->bindParam(":tag", $tag, PDO::PARAM_STR);
        $req->bindParam(":name", $name, PDO::PARAM_STR);
        $req->bindParam(":slug", $slug, PDO::PARAM_STR);

        $req->execute();
    }

    public function deleterental(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {
            // Delete links in rental_category table
            $req = $this->getDb()->prepare('DELETE FROM `rental_category` WHERE `id_category` = :id_category');
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete the category
            $req = $this->getDb()->prepare('DELETE FROM `rental` WHERE `id_category` = :id_category');
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            // Commit the transaction if both operations succeeded
            $this->getDb()->commit();

        } catch (Exception $e) {
            // If any operation fails, an exception is thrown
            // Rollback the transaction
            $this->getDb()->rollBack();
            throw $e; // or handle it in another way depending on your needs
        }
    }
}