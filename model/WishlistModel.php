<?php
class WishlistModel extends Model {
    public function createWishlist(wishlist $wishlist){
        $id_wishlist = $wishlist->getId_wishlist();
        $id_user = $wishlist->getId_user();
        $id_rental = $wishlist->getId_rental();


        $req = $this->getDb()->prepare("INSERT INTO `wishlist`(`id_wishlist`, `id_user`, `id_rental`) VALUES (:id_user, :id_user, :id_rental)");
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_wishlist", $id_wishlist, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();

        $req->closeCursor();

    }
    public function getAllWishlist(){
        $wishlists = [];

        $req = $this->getDb()->query('SELECT `id_wishlist`, `id_user`, `id_rental` FROM `wishlist`');

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
    
    public function getwishlistByRental(int $id_category) {
        $rentals = [];

        $req = $this->getDb()->prepare('SELECT `rental`.`id_rental`, `rental`.`id_user`, `rental`.`title`, `rental`.`capacity`, `rental`.`surface_area`, `rental`.`city`, `rental`.`address`, `rental`.`content` 
            FROM `rental`
            INNER JOIN `rental_category`
            ON `rental_category`.`id_rental` = `rental`.`id_rental`
            INNER JOIN `category`
            ON `rental_category`.`id_category` = `category`.`id_category`
            WHERE `category`.`id_category` = :id_category');
        $req->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $req->execute();

        while ($rentalData = $req->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = new Wishlist($rentalData);
        }

        return $rentals;
    }
}