<?php

class SearchModel extends Model {

    public function getSearchResult($searchTerm){

        $searchTerm = '%' . strtolower($searchTerm) . '%';
        
        $req = $this->getDb()->prepare("SELECT `id`, `author`, `title`, `duration`,`thumbnail`, `content`, `created_at` 
        FROM `recipe`  
        WHERE `title` LIKE :search_term 
        OR `duration` LIKE :search_term 
        OR `content` LIKE :search_term  
        ORDER BY id");

        $req->bindValue(':search_term', $searchTerm, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
        $req->closeCursor();
        return $result;
    }
}