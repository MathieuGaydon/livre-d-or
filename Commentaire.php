<?php
session_start();
require_once __DIR__ . "/classes/Comment.php"; // On inclut la classe Comment

if (!isset($_SESSION['user'])) {
    header("Location: /livre-or/profil/login.php");
    exit();
}

$commentObj = new Comment();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['comment'])) {
    $commentObj->addComment($_SESSION['user'], $_POST['comment']);
    header("Location: commentaire.php");
    exit();
}

$comments = $commentObj->getComments();
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Livre d'or</title>
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
                <li><a href="index.php">Accueil</a></li>
                <li><a href="livre-or.php">Livre d'Or</a></li>
                <li><a href="profil/login.php">Connexion / Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

    <div class="commentaire">
        <h1 class="h1-com">Ajouter un commentaire</h1>
        <form method="POST" action="" class="form-com">
            <textarea name="comment" required class="text-com"></textarea>
            <button type="submit" class="bouton-com">Envoyer</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Livre d'Or. Tous droits réservés.</p>
    </footer>

</body>
</html>
