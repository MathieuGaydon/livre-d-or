<?php
include_once("Database.php");
// Classe User qui hérite de la classe Database
class User extends Database {
    private $user_id;
    private $pdo;
    
    public function __construct() {
        // Appel au constructeur de la classe parent (Database) pour obtenir la connexion PDO
        $this->pdo = $this->getConnection();
        // On vérifie si un utilisateur est connecté
        session_start();  // Assurez-vous que la session est démarrée ici
        $this->user_id = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    // Méthode d'inscription
    public function register($login, $password) {
        // Vérification si l'utilisateur existe déjà
        $stmt = $this->pdo->prepare("SELECT id FROM user WHERE login = :login");
        $stmt->execute(['login' => $login]);
        if ($stmt->rowCount() > 0) {
            return "Ce nom d'utilisateur est déjà pris.";
        } else {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $this->pdo->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
            $stmt->execute(['login' => $login, 'password' => $hashedPassword]);

            return "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        }
    }

    // Méthode de connexion
    public function login($login, $password) {
        // Vérification de l'existence de l'utilisateur
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si l'utilisateur n'existe pas, on renvoie un message d'erreur
        if (!$user) {
            return "Nom d'utilisateur introuvable.";
        }
    
        // Vérification du mot de passe
        if (password_verify($password, $user['password'])) {
            // Connexion réussie, on démarre la session et on stocke l'ID de l'utilisateur
            session_start();
            $_SESSION['user'] = $user['id'];  // Stocker l'ID de l'utilisateur dans la session
            return "Connexion réussie.";
        } else {
            return "Mot de passe incorrect.";
        }
    }

    // Méthode de déconnexion
    public function logout() {
        session_start();
        session_unset();  // Supprimer toutes les variables de session
        session_destroy();  // Détruire la session
        return "Déconnexion réussie.";
    }
        // Vérifie si l'utilisateur est connecté
        public function isLoggedIn() {
            return isset($this->user_id);
        }
    
    
        // Méthode de mise à jour du profil
        public function updateProfile($login, $password) {
            // Si l'utilisateur n'est pas connecté, renvoyer une erreur
            if (!$this->isLoggedIn()) {
                return "Utilisateur non connecté.";
            }
    
            // Préparation de la requête pour mettre à jour le login
            $query = "UPDATE user SET login = :login, password = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Exécution de la requête
            $stmt->execute([
                ':login' => $login,
                ':password' => $hashedPassword,
                ':id' => $this->user_id
            ]);
    
            return "Les informations ont été mises à jour avec succès.";
        }
    
    
        public function getUserInfo() {
            if (!$this->isLoggedIn()) {
                return null;
            }
    
            $stmt = $this->pdo->prepare("SELECT login FROM user WHERE id = :id");
            $stmt->execute(['id' => $this->user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
}
?>
