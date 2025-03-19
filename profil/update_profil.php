<?php
// Inclure la classe User
require_once "../classes/User.php";
// Créer une instance de la classe User
$user = new User();

// Initialiser les variables
$message = '';
$user_info = null;

// Vérifier si l'utilisateur est connecté
if (!$user->isLoggedIn()) {
    header('Location: login.php');  // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Récupérer les informations actuelles de l'utilisateur
$user_info = $user->getUserInfo();

// Par défaut, on masque le mot de passe
$displayPassword = false;

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Vérifier si un mot de passe a été fourni
    if (!empty($password)) {
        // Si un mot de passe est fourni, on le hache
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Sinon, on garde le mot de passe actuel (pas de changement)
        $hashedPassword = null;
    }

    // Appeler la méthode updateProfile pour mettre à jour les informations
    $message = $user->updateProfile($login, $hashedPassword);

    // Récupérer les nouvelles informations après mise à jour
    $user_info = $user->getUserInfo();

    // Si on clique sur le bouton pour afficher le mot de passe, on met à jour l'état
    if (isset($_POST['toggle_password'])) {
        $displayPassword = !$displayPassword;  // Alterner l'état d'affichage du mot de passe
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Modifier mon profil</title>
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
                <li><a href="../index2.php">Accueil</a></li>
                <li><a href="../livre-or.php">Livre d'Or</a></li>
                <li><a href="update_profil.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="livre-or.php">Livre d'Or</a></li>
                <li><a href="profil/login.php">Connexion / Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

    <div class="profil">
        <main class="main-aff-profil">
        </main>
        <main class="main-profil">
            <div class="form-connection">
                <h2 class="h2-profil">Modifier mon profil</h2>

                <!-- Affichage du message -->
                <?php if (!empty($message)): ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>

                <!-- Afficher les informations actuelles avant modification -->
                <h3>Informations actuelles :</h3>
                <h2><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user_info['login']); ?></h2>
                
                <!-- Affichage du mot de passe avec bouton pour afficher/masquer -->
                <h2><strong>Mot de passe :</strong> 
                    <?php 
                    if ($displayPassword) {
                        echo htmlspecialchars($user_info['password']);
                    } else {
                        echo '*****'; 
                    }
                    ?>
                </h2>

                <h3>Modifier mes informations :</h3>
                <form method="POST" class="form-profil">
                    <label for="login" class="label-profil">Nom d'utilisateur (modifier si nécessaire)</label>
                    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user_info['login']); ?>" autocomplete="off" required class="input-profil"><br><br>

                    <label for="password" class="label-profil">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password" value="" autocomplete="off" class="input-profil" require><br><br>

                    <button type="submit" class="bouton-profil">Mettre à jour</button>
                </form>

                <p><a href="logout.php">Se déconnecter</a></p>
            </div>
        </main>
    </div>

    <footer class="update-footer">
        <p>2025 - Tous droits réservés.</p>
    </footer>
</body>
</html>
