<?php
// Inclure la classe User
require_once "../classes/User.php";

// Créer une instance de la classe User (qui hérite de Database)
$user = new User();

// Initialiser la variable de message d'erreur
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les informations du formulaire
    $login = $_POST['username'];  // Nom d'utilisateur
    $password = $_POST['password'];  // Mot de passe

    // Appeler la méthode login de la classe User pour connecter l'utilisateur
    $message = $user->login($login, $password);

    // Si la connexion est réussie, on redirige vers l'accueil
    if ($message === "Connexion réussie.") {
        header('Location: ../index2.php');  // Redirection vers la page d'accueil après connexion réussie
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Connexion</title>
</head>
<body>
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
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../livre-or.php">Livre d'Or</a></li>
                <li><a href="login.php">Connexion / Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
    <div class="form-connection">
    <h2>Connexion</h2>
    <form method="POST">
        <div class="user-log">
            <label for="username" class="label-login"><p>Nom d'utilisateur</p></label>
            <input type="text" id="username" name="username" autocomplete="off" required class="input-login"><br><br>
        </div>
        <div class="mdp-log">
            <label for="password" class="label-login"><p>Mot de passe</p></label>
            <input type="password" id="password" name="password" autocomplete="off" required class="input-login"><br><br>
        </div>
        <button type="submit" class="bouton-login"><p>Se connecter</p></button>

        <!-- Affichage du message d'erreur sous le bouton -->
        <?php if (!empty($message)): ?>
            <div class="error-message"><p><?php echo $message; ?></p></div>
        <?php endif; ?>
    </form>
    <p>Pas encore de compte ? <a href="register.php">Créez-en un !</a></p>
    </div>
</body>
<footer class="login-footer">
    <p>2025 - Tous droits réservés.</p>
</footer>   
</html>
