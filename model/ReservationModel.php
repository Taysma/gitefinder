<?php
class ReservationModel extends Model
{
    //Create
    public function addReservation(Reservation $reservation)
    {
        $id_user = $reservation->getId_user();
        $id_rental = $reservation->getId_rental();
        $available = $reservation->getAvailable();
        $checkin_date = $reservation->getCheckin_date();
        $checkout_date = $reservation->getCheckout_date();
        $validation = $reservation->getValidation();

        $req = $this->getDb()->prepare("INSERT INTO `reservation` (`id_user`, `id_rental`, `available`, `checkin_date`, `checkout_date`, `validation`) 
        VALUES (:id_user, :id_rental, :available, :checkin_date, :checkout_date, :validation)");

        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":available", $available, PDO::PARAM_STR);
        $req->bindParam(":checkin_date", $checkin_date, PDO::PARAM_STR);
        $req->bindParam(":checkout_date", $checkout_date, PDO::PARAM_STR);
        $req->bindParam(":validation", $validation, PDO::PARAM_STR);

        $req->execute();
    }

    //Create
    public function validationReservation(Reservation $reservation)
    {
        $validation = $reservation->getValidation();

        $req = $this->getDb()->prepare("INSERT INTO `reservation` (`validation`) 
        VALUES (NOW())");

        $req->bindParam(":validation", $validation, PDO::PARAM_STR);
        $req->execute();
    }

    //Read
    public function readAllReservationUser(Reservation $reservation)
    {
        $req = $this->getDb()->prepare("SELECT `id_reservation`, `id_user`, `id_rental`, `available`, `checkin_date`, `checkout_date`, `validation` FROM `reservation` WHERE `id_reservation` = :id_reservation");

        $req->bindParam(":id_reservation", $id_reservation, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":available", $available, PDO::PARAM_STR);
        $req->bindParam(":checkin_date", $checkin_date, PDO::PARAM_STR);
        $req->bindParam(":checkout_date", $checkout_date, PDO::PARAM_STR);
        $req->bindParam(":validation", $validation, PDO::PARAM_STR);

        while($reservation = $req->fetch(PDO::FETCH_ASSOC)){
            $reservations[] = new Reservation($reservation);
        }

        $req->execute();
    }

    public function updateReservation(Reservation $reservation)
    {
        $id_reservation = $reservation->getId_reservation();
        $id_user = $reservation->getId_user();
        $id_rental = $reservation->getId_rental();
        $available = $reservation->getAvailable();
        $checkin_date = $reservation->getCheckin_date();
        $checkout_date = $reservation->getCheckout_date();
        $validation = $reservation->getValidation();

        $req = $this->getDb()->prepare("UPDATE `reservation` SET `id_reservation`=':id_reservation',`id_user`=':id_user',`id_rental`=':id_rental',`available`=':available',`checkin_date`=':checkin_date',`checkout_date`=':checkout_date',`validation`=':validation' ");
        $req->bindParam(":id_reservation", $id_reservation, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":available", $available, PDO::PARAM_STR);
        $req->bindParam(":checkin_date", $checkin_date, PDO::PARAM_STR);
        $req->bindParam(":checkout_date", $checkout_date, PDO::PARAM_STR);
        $req->bindParam(":validation", $validation, PDO::PARAM_STR);

        $req->execute();
    }

    public function deleteReservation(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {

            // Delete the reservation
            $req = $this->getDb()->prepare('DELETE FROM `reservation` WHERE `id_reservation` = :id_reservation');
            $req->bindParam('id_reservation', $id, PDO::PARAM_INT);
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