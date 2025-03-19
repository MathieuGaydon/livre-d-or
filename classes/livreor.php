<?php
// Vérifie que tu utilises la bonne méthode dans cette classe.
require_once "Database.php";

class LivreOr extends Database {
    public function getComments($limit, $offset, $search = '') {
        // Si un mot-clé de recherche est fourni, on ajoute une condition WHERE
        $sql = "SELECT comment.*, user.login FROM comment 
                INNER JOIN user ON comment.id_user = user.id";
        
        // Ajouter un filtre pour la recherche
        if (!empty($search)) {
            $sql .= " WHERE comment.comment LIKE :search";
        }

        // Ordre des commentaires par date
        $sql .= " ORDER BY comment.date DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->getConnection()->prepare($sql);
        
        // Si un mot-clé de recherche est spécifié, on le lie
        if (!empty($search)) {
            $searchParam = '%' . $search . '%';
            $stmt->bindParam(":search", $searchParam, PDO::PARAM_STR);
        }

        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countComments($search = '') {
        // Si un mot-clé de recherche est fourni, on ajoute une condition WHERE
        $sql = "SELECT COUNT(*) as count FROM comment";

        // Ajouter un filtre pour la recherche
        if (!empty($search)) {
            $sql .= " WHERE comment.comment LIKE :search";
        }

        $stmt = $this->getConnection()->prepare($sql);
        
        // Si un mot-clé de recherche est spécifié, on le lie
        if (!empty($search)) {
            $searchParam = '%' . $search . '%';
            $stmt->bindParam(":search", $searchParam, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}
?>
