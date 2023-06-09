<?php
class Reservation extends Model {


    public function createReservation(Reservation $reservation){
        $id_reservation = $reservation->getId_reservation();
        $id_user = $reservation->getId_user();
        $id_rental = $reservation->getId_rental();
        $available = $reservation->getAvailable();
        $checkin_date = $reservation->getCheckinDate();
        $checkout_date = $reservation->getCheckoutDate();
        $validation = $reservation->getValidation();
        
        
        

        $req = $this->getDb()->prepare("INSERT INTO `` (``, ``, ``, ``, ``, ``, ``, ``) VALUES (:, :, :, :, :, :, :, :)");
        $req->bindParam(":", $, PDO::PARAM_INT);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        $req->bindParam(":", $, PDO::PARAM_STR);
        

        $req->execute();

        $req->closeCursor();
    }
}