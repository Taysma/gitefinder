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

    public function addWish(Wishlist $wish, int $id_rental)
    {
        $id_user = $_SESSION['id_user'];

        $req = $this->getDb()->prepare("INSERT INTO `wishlist`(`id_user`, `id_rental`) VALUES (:id_user, :id_rental)");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();
    }

    public function isInWishlist($userId, $rentalId)
    {
        $req = $this->getDb()->prepare('SELECT COUNT(*) FROM `wishlist` WHERE `id_user` = :id_user AND `id_rental` = :id_rental');
        $req->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $req->bindParam(':id_rental', $rentalId, PDO::PARAM_INT);
        $req->execute();

        return $req->fetchColumn() > 0;
    }

    public function deleteWish(int $id_user, $id_rental)
    {
        $req = $this->getDb()->prepare('DELETE FROM `wishlist` WHERE `id_user` = :id_user AND `id_rental` = :id_rental');
        $req->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam('id_rental', $id_rental, PDO::PARAM_INT);
        $req->execute();
    }
}
