<?php
// Inclure la classe User
require_once "../classes/User.php";

// Créer une instance de la classe User (qui hérite de Database)
$user = new User();

// Initialiser la variable de message
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Récupérer le nom d'utilisateur depuis le formulaire
    $password = $_POST['password'];  // Récupérer le mot de passe depuis le formulaire

    // Appeler la méthode register de la classe User pour inscrire l'utilisateur
    $message = $user->register($username, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Inscription</title>
</head>
<header>
    <nav>
        <!-- Le bouton hamburger -->
        <div class="hamburger" id="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <ul id="menu" class="menu">
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="index2.php">Accueil</a></li>
                <li><a href="livre-or.php">Livre d'Or</a></li>
                <li><a href="profil/update_profil.php">Profil</a></li>
                <li><a href="profil/logout.php">Déconnexion</a></li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="livre-or.php">Livre d'Or</a></li>
                <li><a href="profil/login.php">Connexion / Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<body>
<div class="form-connection">
    <h2>Inscription</h2>
    <form method="POST">
        <div class="user-log">
            <label for="username" class="label-login">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" autocomplete="off" required class="input-login"><br><br>
        </div>
        <div class="mdp-log">
            <label for="password" class="label-login">Mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="off" required class="input-login"><br><br>
        </div>
        <button type="submit" class="bouton-login">S'inscrire</button>
        <!-- Affichage du message d'erreur sous le bouton -->
        <?php if (!empty($message)): ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>
        <p>Tu veux te connecter maintenant ? <a href="login.php">C'est ici !</a></p>
    </form>
</div>
</body>
<footer class="register-footer">
    <p>2025 - Tous droits réservés.</p>
</footer>
</html>
