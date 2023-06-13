<?php
class RentalModel extends Model
{

    public function getLastTenPost(){
        $rentals = [];

        $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content` FROM `rental` ORDER BY `id` DESC LIMIT 50');

        while($rental = $req->fetch(PDO::FETCH_ASSOC)){
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }

    public function getAllrentals(){
        $rentals = [];

        $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content` FROM `rental` ORDER BY `id_rental` DESC');

        while($rental = $req->fetch(PDO::FETCH_ASSOC)){
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }

    public function getOnerental(int $id_rental){

        $req = $this->getDb()->prepare('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content` FROM `rental` WHERE `id_rental`= :id');
        $req->bindParam('id_rental',$id_rental,PDO::PARAM_INT);
        $req->execute();

        $rental = new Rental($req->fetch(PDO::FETCH_ASSOC));

        return $rental;
    }

    public function getUserrentals(int $id_user){
        $rentals = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content`, `user`.`id_user`, `user`.`firstname`, `user`.`lastname`, `user`.`mail`, `user`.`birthdate`, `user`.`password`, `user`.`content`, `user`.`roles`
            FROM `rental`
            INNER JOIN `user`
            ON `rental`.`id_user` = `user`.`id_user`
            WHERE `rental`.`id_user` = :id');
        $req->bindParam(':id', $id_user, PDO::PARAM_INT);
        $req->execute();

        while ($rentalData = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Rental($rentalData);
        }

        $req->closeCursor();
        return $rentals;
    }

    public function addrental (Rental $rental){
        $id_rental = $rental->getId_rental();
        $id_user = $rental->getId_user();
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $city = $rental->getCity();
        $address = $rental->getAddress();
        $content = $rental->getContent();


        $req = $this->getDb()->prepare('INSERT INTO `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content` ) VALUES (:id_rental, :id_user, :title, :capacity, :surface_area, :city, :address, :content )');

        $req->bindParam('id_rental', $id_rental, PDO::PARAM_INT);
        $req->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam('surface_area', $surface_area, PDO::PARAM_INT);
        $req->bindParam('city', $city, PDO::PARAM_STR);
        $req->bindParam('address', $address, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);

        $req->execute();
    }

    public function editrental(rental $rental) {
        $id_rental = $rental->getId_rental();
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $city = $rental->getCity();
        $address = $rental->getAddress();
        $content = $rental->getContent();

        $req = $this->getDb()->prepare('UPDATE `rental` SET `title` = :title, `capacity` = :capacity, `surface_area` = :surface_area, `city` = :city, `address` = :address,`content` = :content WHERE `id_rental` = :id');

        $req->bindParam(':id_rental', $id_rental, PDO::PARAM_INT);
        $req->bindParam(':title', $title, PDO::PARAM_STR);
        $req->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam(':surface_area', $surface_area, PDO::PARAM_INT);
        $req->bindParam(':city', $city, PDO::PARAM_STR);
        $req->bindParam(':address', $address, PDO::PARAM_STR);
        $req->bindParam(':content', $content, PDO::PARAM_STR);


        $req->execute();
    }


    public function deleteRental(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {
            // Delete links in rental_category table
            $req = $this->getDb()->prepare('DELETE FROM `rental_category` WHERE `id_rental` = :id');
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            // Delete the rental
            $req = $this->getDb()->prepare('DELETE FROM `rental` WHERE `id_rental` = :id');
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            // Commit the transaction if both operations succeeded
            $this->getDb()->commit();
        } catch (Exception $e) {
            // If any operation fails, an exception is thrown
            // Rollback the transaction
            $this->getDb()->rollBack();
            throw $e;  // or handle it in another way depending on your needs
        }
    }
}