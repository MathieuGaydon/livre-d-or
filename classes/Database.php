<?php
class Database {
    private $host = 'localhost';       // Hôte de la base de données
    private $db_name = 'livreor';      // Nom de la base de données
    private $username = 'root';        // Nom d'utilisateur (à adapter selon ta configuration)
    private $password = '';            // Mot de passe (à adapter selon ta configuration)
    private $conn;

    // Méthode pour établir la connexion
    public function getConnection() {
        $this->conn = null;

        try {
            // Créer une nouvelle connexion PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            // Définir le mode d'erreur pour PDO à Exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Si erreur, afficher l'exception
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
