<?php
class PictureModel extends Model{
    
    //create

public function createPicture(Picture $picture){
    $id_rental = $picture->getId_Rental();
    $title = $picture->getTitle();
    
    $req = $this->getDb()->prepare("INSERT INTO `picture` (`id_rental`, `title`) VALUES (:id_rental, :title)");
    
    $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
    $req->bindParam(":title", $title, PDO::PARAM_STR);
    
    

    $req->execute();

    $req->closeCursor();
}

//read

public function readOnePicture(Picture $picture)
{
    $id_picture = $picture->getId_picture();
    $id_rental = $picture->getId_Rental();
    $title = $picture->getTitle();

    $req = $this->getDb()->prepare("SELECT `id_picture`, `id_rental`, `title` FROM `picture` WHERE `id_picture` = :id_picture");

    $req->bindParam(":id_picture", $id_picture, PDO::PARAM_INT);
    $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
    $req->bindParam(":title", $title, PDO::PARAM_STR);

    $req->execute();

    $picture = $req->fetch(PDO::FETCH_ASSOC);

    return $picture;
}



  //update

  public function updatePicture(Picture $picture){
    $id_rental = $picture->getId_Rental();
    $title = $picture->getTitle();


    $req = $this->getDb()->prepare("UPDATE `picture` SET `id_rental`=':id_rental',`title`=':title' ");
    
    $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
    $req->bindParam(":title", $title, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();

}


//delete

public function delete(int $id){
            // Start a new transaction
            $this->getDb()->beginTransaction();
            
            try {
                
        
                // Delete the table
                $req = $this->getDb()->prepare('DELETE FROM `picture` WHERE `id_picture` = :champ');
                $req->bindParam('id_picture', $id, PDO::PARAM_INT);
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


    public function getPicturesByRentalId($id_rental) {
        $pictures = [];
        $req = $this->getDb()->prepare("SELECT `id_picture`, `id_rental`, `title` FROM `picture` WHERE `id_rental` = :id_rental");
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->execute();
        
    
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $pictures[] = new Picture($row);
        }
    
        return $pictures;
    }
    

}