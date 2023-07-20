<?php
class NewsletterModel extends Model
{
    //create
    public function createNewSubscribe(Newsletter $newsletter)
    {
        $mail = $newsletter->getMail();

        $req = $this->getDb()->prepare("INSERT INTO `newsletter` (`mail`) VALUES (:mail)");
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();
    }

    //read
    public function readNewsletter(Newsletter $newsletter)
    {
        $id_newsletter = $newsletter->getId_newsletter();
        $mail = $newsletter->getMail();

        $req = $this->getDb()->prepare("SELECT `id_newsletter`, `mail`FROM `newsletter` WHERE `id_newsletter` = :id_newsletter");
        $req->bindParam(":id_newsletter", $id_newsletter, PDO::PARAM_INT);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();
    }

    //update
    public function updateNewsletter(Newsletter $newsletter)
    {
        $id_newsletter = $newsletter->getId_newsletter();
        $mail = $newsletter->getMail();

        $req = $this->getDb()->prepare("UPDATE `` SET ``=':',``=':',``=':' ");
        $req->bindParam(":id_newsletter", $id_newsletter, PDO::PARAM_INT);
        $req->bindParam(":mail", $mail, PDO::PARAM_STR);
        $req->execute();
    }


    //delete
    public function deleteNewsletter(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {
            // Delete the table
            $req = $this->getDb()->prepare('DELETE FROM `newsletter` WHERE `id_newsletter` = :id_newsletter');
            $req->bindParam('id_newsletter', $id, PDO::PARAM_INT);
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
