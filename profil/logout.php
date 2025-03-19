<?php
// Inclure les fichiers nécessaires
require_once "../classes/User.php";

// Créer une instance de la classe User (qui hérite de Database)
$user = new User();

// Appeler la méthode logout pour se déconnecter
$message = $user->logout();

// Afficher un message de déconnexion
echo $message;

// Rediriger l'utilisateur vers la page d'accueil après la déconnexion
header('Location: ../index.php');
exit;
?>
