<?php
//session_start();
include 'layouts/header.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php?action=login");
    exit;
}

// Échapper les données de la session pour éviter les attaques XSS
$nom = htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8');
$prenom = htmlspecialchars($_SESSION['prenom'], ENT_QUOTES, 'UTF-8');
$role = htmlspecialchars($_SESSION['role'], ENT_QUOTES, 'UTF-8');
?>

<div class="container">

</div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6 text-center">
            <h1 class="display-4">Connexion réussie !</h1>
            <h2 class="display-6">Bienvenue sur votre session, <?php echo "$nom $prenom"; ?>.</h2>
            <p>Votre rôle est : <?php echo $role; ?></p>
        </div>
    </div>

<?php
include 'layouts/footer.html';
