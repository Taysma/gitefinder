<?php
class ReviewModel extends Model
{
    //create
    public function createReview(Review $review)
    {
        $id_review = $review->getId_review();
        $id_user = $review->getId_user();
        $id_rental = $review->getId_rental();

        $req = $this->getDb()->prepare("INSERT INTO `review` (`id_review`, `id_user`, `id_rental`) VALUES (:id_review, :id_user, :id_rental)");
        $req->bindParam(":id_review", $id_review, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();
    }

    //read
    public function readOneReview(Review $review)
    {
        $id_review = $review->getId_review();
        $id_user = $review->getId_user();
        $id_rental = $review->getId_rental();

        $req = $this->getDb()->prepare("SELECT `id_review`, `id_user`, `id_rental`, `content`, `rating`, `created_at` FROM `review` WHERE `id_review` = :id_review");

        $req->bindParam(":id_review", $id_review, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();
    }

    //update
    public function updateReview(Review $review)
    {
        $id_review = $review->getId_review();
        $id_user = $review->getId_user();
        $id_rental = $review->getId_rental();

        $req = $this->getDb()->prepare("UPDATE `review` SET `id_review`=':id_review',`id_user`=':id_user',`id_rental`=':id_rental' ");

        $req->bindParam(":id_review", $id_review, PDO::PARAM_INT);
        $req->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $req->bindParam(":id_rental", $id_rental, PDO::PARAM_INT);

        $req->execute();
    }

    //delete
    public function deleteReview(int $id)
    {
        // Start a new transaction
        $this->getDb()->beginTransaction();

        try {
            // Delete the review
            $req = $this->getDb()->prepare('DELETE FROM `review` WHERE `id_review` = :id_review');
            $req->bindParam('id_review', $id, PDO::PARAM_INT);
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