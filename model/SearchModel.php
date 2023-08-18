<?php
class SearchModel extends Model {

    public function getSearchResult($searchTerm)
    {
        $searchTerm = '%' . strtolower($searchTerm) . '%';
        
        $req = $this->getDb()->prepare("SELECT `id_rental`, `id_user`, `title`, `capacity`, `surface_area`, `content`, `city`, `address`,   
        FROM `rental`  
        WHERE id_user LIKE CONCAT('%', :search_term, '%')
        OR id_user LIKE CONCAT('%', :search_term, '%')
        OR title LIKE CONCAT('%', :search_term, '%')
        OR capacity LIKE CONCAT('%', :search_term, '%')
        OR surface_area LIKE CONCAT('%', :search_term, '%')
        OR content LIKE CONCAT('%', :search_term, '%')
        OR city LIKE CONCAT('%', :search_term, '%')
        OR address LIKE CONCAT('%', :search_term, '%') ");

        $req->bindValue(':search_term', $searchTerm, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
        $req->closeCursor();
        return $result;
    }
}