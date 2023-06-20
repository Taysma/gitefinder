<?php
class RentalModel extends Model
{

    public function createRental (Rental $rental){
        $id_user = $rental->getId_user();
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $city = $rental->getCity();
        $address = $rental->getAddress();
        $content = $rental->getContent();
        $country = $rental->getCountry();

        $req = $this->getDb()->prepare('INSERT INTO `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content`, `country` ) VALUES (:id_rental, :id_user, :title, :capacity, :surface_area, :city, :address, :content, :country )');

        $req->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam('surface_area', $surface_area, PDO::PARAM_INT);
        $req->bindParam('city', $city, PDO::PARAM_STR);
        $req->bindParam('address', $address, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);
        $req->bindParam('country', $country, PDO::PARAM_STR);

        $req->execute();
    }

    public function getLastTenPost(){
        $rentals = [];

        $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `content`, `country` FROM `rental` ORDER BY `id` DESC LIMIT 50');

        while($rental = $req->fetch(PDO::FETCH_ASSOC)){
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }
////////////////////////////////////////////////////////
    public function getAllrentals(){
        $rentals = [];

    $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `country`
        FROM `rental`
        ORDER BY `id_rental` DESC');

    while ($rental = $req->fetch(PDO::FETCH_ASSOC)) {
        $id_rental = $rental['id_rental'];
        $rentalData = $this->getRentalPicture($id_rental);
        $pictures = [];
        
        foreach ($rentalData as $row) {
            $picture = new Picture($row);
            $pictures[] = $picture;
        }
        
        $rental['pictures'] = $pictures;
        $rentals[] = new Rental($rental);
    }

    return $rentals;
    }
/////////////////////////////////////////////////////////
    public function getOneRental(int $id_rental){

        $req = $this->getDb()->prepare('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`, `country` FROM `rental` WHERE `id_rental`= :id');
        $req->bindParam('id',$id_rental,PDO::PARAM_INT);
        $req->execute();

        $rental = new Rental($req->fetch(PDO::FETCH_ASSOC));

        return $rental;
    }
////////////////////////////////////////////////////
    public function getUserrentals(int $id_user){
        $rentals = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content`,`rental`.`country`, `user`.`id_user`, `user`.`firstname`, `user`.`lastname`, `user`.`mail`, `user`.`birthdate`, `user`.`password`, `user`.`content`, `user`.`roles`
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

    public function getRentalPicture($id_rental){
        $rentalData = [];
        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content`, `rental`.`country`, `rental`.`price`, `picture`.`id_picture`, `picture`.`id_rental`, `picture`.`title`
            FROM `rental`
            INNER JOIN `picture`
            ON `rental`.`id_rental` = `picture`.`id_rental`
            WHERE `rental`.`id_rental` = :id_rental');
        $req->bindParam(':id_rental', $id_rental, PDO::PARAM_INT);
        $req->execute();
        
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentalData[] = $row;
        }

        var_dump($row);

        
    
        $req->closeCursor();
        return $rentalData;
    }
    

    

    public function updateRental(rental $rental) {
        $id_rental = $rental->getId_rental();
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $city = $rental->getCity();
        $address = $rental->getAddress();
        $content = $rental->getContent();
        $country = $rental->getCountry();

        $req = $this->getDb()->prepare('UPDATE `rental` SET `title` = :title, `capacity` = :capacity, `surface_area` = :surface_area, `city` = :city, `address` = :address,`content` = :content, `country` = :country WHERE `id_rental` = :id');

        $req->bindParam(':id_rental', $id_rental, PDO::PARAM_INT);
        $req->bindParam(':title', $title, PDO::PARAM_STR);
        $req->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam(':surface_area', $surface_area, PDO::PARAM_INT);
        $req->bindParam(':city', $city, PDO::PARAM_STR);
        $req->bindParam(':address', $address, PDO::PARAM_STR);
        $req->bindParam(':content', $content, PDO::PARAM_STR);
        $req->bindParam('country', $country, PDO::PARAM_STR);


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