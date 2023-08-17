<?php
class ReservationModel extends Model
{
    //Create
    public function addReservation(Reservation $reservation)
    {
        $id_user = $_SESSION['id_user'];
        $id_rental = $reservation->getId_rental();
        $checkin_date = $this->convertToMySQLDateFormat($reservation->getCheckin_date());
        $checkout_date = $this->convertToMySQLDateFormat($reservation->getCheckout_date());
        $num_guest = $reservation->getNum_guest();
        $total_price = $reservation->getTotal_price();

        $req = $this->getDb()->prepare("INSERT INTO `reservation` (`id_user`, `id_rental`, `checkin_date`, `checkout_date`, `num_guest`, `total_price`) 
            VALUES (:id_user, :id_rental, :checkin_date, :checkout_date, :num_guest, :total_price)");

        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":checkin_date", $checkin_date, PDO::PARAM_STR);
        $req->bindParam(":checkout_date", $checkout_date, PDO::PARAM_STR);
        $req->bindParam(":num_guest", $num_guest, PDO::PARAM_STR);
        $req->bindParam(":total_price", $total_price, PDO::PARAM_INT);

        $req->execute();
    }

    private function convertToMySQLDateFormat($date)
    {
        return \DateTime::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    }








    //Read
    public function getAllUserReservation()
    {
        $id_user = $_SESSION['id_user'];
        $reservations = [];


        $req = $this->getDb()->prepare("SELECT `id_reservation`, `id_user`, `id_rental`, `checkin_date`, `checkout_date`, `num_guest`, `total_price` FROM `reservation` WHERE `id_user` = :id_user ORDER BY `id_reservation` DESC");

        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->execute();

        while ($reservation = $req->fetch(PDO::FETCH_ASSOC)) {
            $reservations[] = new Reservation($reservation);
        }

        return $reservations;
    }

    public function updateReservation(Reservation $reservation)
    {
        $id_reservation = $reservation->getId_reservation();
        $id_user = $reservation->getId_user();
        $id_rental = $reservation->getId_rental();
        $checkin_date = $reservation->getCheckin_date();
        $checkout_date = $reservation->getCheckout_date();

        $req = $this->getDb()->prepare("UPDATE `reservation` SET `id_reservation`=':id_reservation',`id_user`=':id_user',`id_rental`=':id_rental',`available`=':available',`checkin_date`=':checkin_date',`checkout_date`=':checkout_date',`validation`=':validation' ");
        $req->bindParam(":id_reservation", $id_reservation, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":checkin_date", $checkin_date, PDO::PARAM_STR);
        $req->bindParam(":checkout_date", $checkout_date, PDO::PARAM_STR);

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
