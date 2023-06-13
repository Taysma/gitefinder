<?php
class MessagerieModel extends Model{
    
    //create

public function create(Chat $chat){
    $id_chat = $chat->getId_chat();
    $id_user = $chat->getId_user();
    $id_rental = $chat->getId_rental();
    $content = $chat->getContent();
    
    $req = $this->getDb()->prepare("INSERT INTO `chat` (`id_chat`, `id_user`, `id_rental`, `content`) VALUES (:id_chat, :id_user, :id_rental, :content)");
   
    $req->bindParam(":id_chat", $id_chat, PDO::PARAM_INT);
    $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
    $req->bindParam(":content", $content, PDO::PARAM_STR);
    
    

    $req->execute();

    
}

//read

public function read(Chat $chat)
{
    $id_chat = $chat->getId_chat();
    $id_user = $chat->getId_user();
    $id_rental = $chat->getId_rental();
    $content = $chat->getContent();

    $req = $this->getDb()->prepare("SELECT `id_chat`, `id_user`, `id_rental`, `content` FROM `chat` WHERE `id_chat` = :id_chat");

    $req->bindParam(":id_chat", $id_chat, PDO::PARAM_INT);
    $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
    $req->bindParam(":content", $content, PDO::PARAM_STR);

    $req->execute();
}

  //update

  public function update(Chat $chat){
    $id = $->getId();
    $ = $->get();
    $ = $->get();


    $req = $this->getDb()->prepare("UPDATE `` SET ``=':',``=':',``=':' ");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->bindParam(":", $, PDO::PARAM_);
    $req->bindParam(":", $, PDO::PARAM_);

    $req->execute();

    $req->closeCursor();

}


//delete

public function delete(int $id){
            // Start a new transaction
            $this->getDb()->beginTransaction();
            
            try {
                // Delete links in  table
                $req = $this->getDb()->prepare('DELETE FROM `table` WHERE `champ` = :champ');
                $req->bindParam('champ', $champ, PDO::PARAM_);
                $req->execute();
        
                // Delete the table
                $req = $this->getDb()->prepare('DELETE FROM `table` WHERE `champ` = :champ');
                $req->bindParam('champ', $id, PDO::PARAM_);
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















