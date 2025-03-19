<?php
require_once __DIR__ . "/Database.php";

class Comment {
    private $pdo;

    public function __construct() {
        // Crée une instance de la classe Database et récupère la connexion PDO
        $database = new Database();  // Assurez-vous que c'est bien Database et pas Database::getConnection()
        $this->pdo = $database->getConnection();  // Cette ligne appelle getConnection
    }

    public function addComment($userId, $comment) {
        $stmt = $this->pdo->prepare("INSERT INTO comment (comment, id_user, date) VALUES (?, ?, NOW())");
        return $stmt->execute([$comment, $userId]);
    }

    public function getComments() {
        $stmt = $this->pdo->query("SELECT c.comment, c.date, u.login FROM comment c JOIN user u ON c.id_user = u.id ORDER BY c.date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
