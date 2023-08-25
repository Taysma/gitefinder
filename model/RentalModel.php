<?php
class RentalModel extends Model
{
    public function addRental($id_user, Rental $rental)
    {
        $id_user = $_SESSION['id_user'];
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $address = $rental->getAddress();
        $content = $rental->getContent();
        $cover = $rental->getCover();
        $price = $rental->getPrice();
        $latitude = $rental->getLatitude();
        $longitude = $rental->getLongitude();

        $req = $this->getDb()->prepare('INSERT INTO `rental` (`id_user`, `title`, `capacity`, `surface_area`, `address`, `content`, `cover`, `price`, `latitude`, `longitude`) VALUES ( :id_user, :title, :capacity, :surface_area,   :address, :content, :cover,  :price, :latitude, :longitude )');

        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam(':title', $title, PDO::PARAM_STR);
        $req->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam(':surface_area', $surface_area, PDO::PARAM_STR);
        $req->bindParam(':address', $address, PDO::PARAM_STR);
        $req->bindParam(':content', $content, PDO::PARAM_STR);
        $req->bindParam(':cover', $cover, PDO::PARAM_STR);
        $req->bindParam(':price', $price, PDO::PARAM_INT);
        $req->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $req->bindParam(':longitude', $longitude, PDO::PARAM_STR);

        $queryNewRental = $req->execute();

        if ($queryNewRental) {
            // Récupérer l'ID généré automatiquement
            $insertEtRecupId = $this->getDb()->lastInsertId();
            return $insertEtRecupId;
        }
    }

    public function addRentalCategory(int $insertEtRecupId, $id_category)
    {

        $req = $this->getDb()->prepare(' INSERT INTO `rental_category`(`id_category`, `id_rental`) VALUES (:id_category, :id_rental)');
        $req->bindParam('id_category', $id_category, PDO::PARAM_INT);
        $req->bindParam(':id_rental', $insertEtRecupId, PDO::PARAM_INT);

        $req->execute();
    }

    public function getLastTenPost()
    {
        $rentals = [];

        $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `address`, `content`, `price`, `latitude`, `longitude`  FROM `rental` ORDER BY `id` DESC LIMIT 50');

        while ($rental = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }

    public function getAllRentals()
    {
        $rentals = [];

        $req = $this->getDb()->query('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `cover`,   `address`,  `price`, `latitude`, `longitude` FROM rental ORDER BY id_rental DESC');

        while ($rental = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Rental($rental);
        }

        return $rentals;
    }

    public function getOneRental(int $id_rental)
    {
        $req = $this->getDb()->prepare('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `cover`,  `address`,  `price`, `latitude`, `longitude` FROM `rental` WHERE `id_rental`= :id');
        $req->bindParam('id', $id_rental, PDO::PARAM_INT);
        $req->execute();

        $rental = new Rental($req->fetch(PDO::FETCH_ASSOC));

        return $rental;
    }

    public function getUserRentals($id_user)
    {
        $rentalsUser = [];

        $req = $this->getDb()->prepare('SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `cover`,   `address`,  `price`, `latitude`, `longitude` FROM rental WHERE `id_user` = :id_user ORDER BY id_rental DESC');


        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();

        while ($rentals = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentalsUser[] = new Rental($rentals);
        }

        return $rentalsUser;
    }

    public function updateRental(Rental $rental)
    {
        $id_rental = $rental->getId_rental();
        $title = $rental->getTitle();
        $capacity = $rental->getCapacity();
        $surface_area = $rental->getSurface_area();
        $cover = $rental->getCover();
        $address = $rental->getAddress();
        $content = $rental->getContent();
        $price = $rental->getPrice();
        $latitude = $rental->getLatitude();
        $longitude = $rental->getLongitude();

        $req = $this->getDb()->prepare('UPDATE `rental` SET `title` = :title, `capacity` = :capacity, `surface_area` = :surface_area,  `cover` = :cover,`address` = :address,`content` = :content,  `price` = :price , `latitude` = :latitude, `longitude` = :longitude WHERE `id_rental` = :id_rental');

        $req->bindParam(':id_rental', $id_rental, PDO::PARAM_INT);
        $req->bindParam(':title', $title, PDO::PARAM_STR);
        $req->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $req->bindParam(':surface_area', $surface_area, PDO::PARAM_INT);
        $req->bindParam(':cover', $cover, PDO::PARAM_STR);
        $req->bindParam(':address', $address, PDO::PARAM_STR);
        $req->bindParam(':content', $content, PDO::PARAM_STR);
        $req->bindParam(':price', $price, PDO::PARAM_INT);
        $req->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $req->bindParam(':longitude', $longitude, PDO::PARAM_STR);

        $req->execute();
    }

    public function updateRentalCategory(int $id_rental, $id_category)
    {
        $req = $this->getDb()->prepare('UPDATE `rental_category` SET `id_category`=:id_category WHERE `id_rental`=:id_rental');
        $req->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $req->bindParam(':id_rental', $id_rental, PDO::PARAM_INT);

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
            throw $e; // or handle it in another way depending on your needs
        }
    }

    public function deleteUserReservation(int $id_user, $id_rental)
    {
        $req = $this->getDb()->prepare('DELETE FROM `reservation` WHERE `id_user` = :id_user AND `id_rental` = :id_rental');
        $req->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam('id_rental', $id_rental, PDO::PARAM_INT);
        $req->execute();
    }
}
