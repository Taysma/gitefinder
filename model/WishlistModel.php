<?php
class WishlistModel extends Model {
    public function createWishlist(wishlist $wishlist){
        $id_user = $wishlist->getId_user();
        $id_rental = $wishlist->getId_rental();


        $req = $this->getDb()->prepare("INSERT INTO `wishlist`(`id_user`, `id_rental`) VALUES (:id_wishlist, :id_user, :id_rental)");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();

        $req->closeCursor();

    }

    public function updateWishlist(wishlist $wishlist){
        $id_wishlist = $wishlist->getId_wishlist();
        $id_user = $wishlist->getId_user();
        $id_rental = $wishlist->getId_rental();


        $req = $this->getDb()->prepare("UPDATE `wishlist` SET `id_wishlist`=':id_wishlist',`id_user`=':id_user',`id_rental`=':id_rental' ");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_wishlist", $id_wishlist, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();

        $req->closeCursor();

    }
    public function getAllWishlist(){
        $id_user = $_SESSION['id_user'];
        $wishlists = [];

        $req = $this->getDb()->prepare('SELECT `id_wishlist` , `id_user`,`id_rental` FROM `wishlist` WHERE `id_user`= :id_user');
        $req->bindParam('id_user',$id_user,PDO::PARAM_INT);
        $req->execute();

        while($wishlist = $req->fetch(PDO::FETCH_ASSOC)){
            $wishlists[] = new Wishlist($wishlist);
            
        }
        
        return $wishlists;
        
    }

    public function getOneWishlist(int $id_wishlist){

        $req = $this->getDb()->prepare('SELECT `id_wishlist`, `id_user`, `id_rental` FROM `wishlist` WHERE `id_wishlist` = :id_wishlist');
        $req->bindParam('id_wishlist',$id_wishlist,PDO::PARAM_INT);
        $req->execute();

        $category = new Wishlist($req->fetch(PDO::FETCH_ASSOC));

        return $category;
    }
    
    public function getwishlistByRental(int $id_wishlist) {
        $contentWishlist = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content` 
            FROM `rental`
            INNER JOIN `wishlist`
            ON `wishlist`.`id_rental` = `rental`.`id_rental`
            INNER JOIN `user`
            ON `wishlist`.`id_user` = `user`.`id_user`
            WHERE `user`.`id_user` = :id_user');
        $req->bindParam(':id_wishlist', $id_wishlist, PDO::PARAM_INT);
        $req->execute();

        while ($contentWishlistData = $req->fetch(PDO::FETCH_ASSOC)) {
            $contentWishlist[] = new Wishlist($contentWishlistData);
        }

        return $contentWishlist;
    }

    public function deleteWishlist(int $id){
        // Start a new transaction
        $this->getDb()->beginTransaction();
        
        try {
           
            // Delete the wishlist
            $req = $this->getDb()->prepare('DELETE FROM `wishlist` WHERE `id_wishlist` = :id_wishlist');
            $req->bindParam('id_wishlist', $id, PDO::PARAM_INT);
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