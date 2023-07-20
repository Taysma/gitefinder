<?php
class MessagerieModel extends Model
{
    //Create
    public function createMessage(Chat $chat)
    {
        $id_chat = $chat->getId_chat();
        $id_user = $chat->getId_user();
        $id_rental = $chat->getId_rental();
        $content = $chat->getContent();
        $send_at = $chat->getSend_at();

        $req = $this->getDb()->prepare("INSERT INTO `chat` (`id_chat`, `id_user`, `id_rental`, `content`, `send_at`) VALUES (:id_chat, :id_user, :id_rental, :content, :send_at)");

        $req->bindParam(":id_chat", $id_chat, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":content", $content, PDO::PARAM_STR);
        $req->bindParam(":send_at", $send_at, PDO::PARAM_STR);

        $req->execute();
    }

    //Read
    public function readMessage(Chat $chat)
    {
        $id_chat = $chat->getId_chat();

        $req = $this->getDb()->prepare("SELECT `id_chat`, `id_user`, `id_rental`, `content`, `send_at` FROM `chat` WHERE `id_chat` = :id_chat");
        $req->bindParam(":id_chat", $id_chat, PDO::PARAM_INT);

        $req->execute();
    }

    //Update
    public function updateMessage(Chat $chat)
    {
        $id_chat = $chat->getId_chat();
        $id_user = $chat->getId_user();
        $id_rental = $chat->getId_rental();
        $content = $chat->getContent();
        $send_at = $chat->getSend_at();

        $req = $this->getDb()->prepare("UPDATE `chat` SET `id_chat`=':id_chat',`id_user`=':id_user',`id_rental`=':id_rental',`content`=':content',`send_at`=':send_at' ");

        $req->bindParam(":id_chat", $id_chat, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);
        $req->bindParam(":content", $content, PDO::PARAM_STR);
        $req->bindParam(":send_at", $send_at, PDO::PARAM_STR);

        $req->execute();
    }

    //Delete
    public function deleteMessage(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {


            // Delete the table
            $req = $this->getDb()->prepare('DELETE FROM `chat` WHERE `id_chat` = :id_chat');
            $req->bindParam('id_chat', $id, PDO::PARAM_INT);
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
