<?php
class WishlistModel extends Model
{
    public function getWish()
    {
        $id = $_SESSION['id_user'];
        $wishlists = [];

        $req = $this->getDb()->prepare('SELECT `id_user`,`id_rental` FROM `wishlist` WHERE `id_user`= :id_user');
        $req->bindParam(':id_user', $id, PDO::PARAM_INT);
        $req->execute();

        while ($wish = $req->fetch(PDO::FETCH_ASSOC)) {
            $wishlists[] = new Wishlist($wish);
        }

        return $wishlists;
    }

    public function addWish(Wishlist $wish)
    {
        $id_user = $wish->getId_user();
        $id_rental = $wish->getId_rental();

        $req = $this->getDb()->prepare("INSERT INTO `wishlist`(`id_user`, `id_rental`) VALUES (:id_user, :id_rental)");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();
    }

    public function deleteWish(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {

            // Delete the wishlist
            $req = $this->getDb()->prepare('DELETE FROM `wishlist` WHERE `id_wishlist` = :id_wishlist');
            $req->bindParam('id_wishlist', $id, PDO::PARAM_INT);
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
