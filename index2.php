<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Livre d'Or</title>
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

    <main class="main-index">
        <h1>Bienvenue sur notre Livre d'Or</h1>
        <p>Merci de visiter notre site ! Lisez les témoignages et laissez le vôtre dans notre Livre d'Or.</p>

        <section>
            <h2>Qu'est-ce qu'un Livre d'Or ?</h2>
            <p>C'est un espace pour partager vos impressions et expériences avec la communauté.</p>
        </section>

        <section>
            <h2>Fonctionnalités</h2>
            <ul>
                <li>Lire des témoignages d'autres visiteurs.</li>
                <li>Laisser un message (sur la page dédiée).</li>
            </ul>
        </section>

        <section>
            <h2>Pourquoi laisser un message ?</h2>
            <p>Partagez vos impressions et contribuez à la communauté.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Livre d'Or. Tous droits réservés.</p>
    </footer>
</body>
</html>