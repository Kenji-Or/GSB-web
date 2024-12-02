<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');

// Échapper les données de la session pour éviter les attaques XSS
$nom = htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8');
$prenom = htmlspecialchars($_SESSION['prenom'], ENT_QUOTES, 'UTF-8');
$role = $_SESSION['role'];
?>

<div class="container my-4 flex-grow-1">
    <!-- Message de bienvenue -->
    <div class="welcome-section text-center p-4 bg-light rounded">
        <h1>Bienvenue <?php echo $prenom; ?> sur l’intranet GSB</h1>
    </div>

    <!-- Affichage du message d'erreur -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-2">
            <?php
            // Utilisation de htmlspecialchars pour éviter les attaques XSS
            echo htmlspecialchars($_SESSION['error']);
            // Supprimer le message d'erreur après l'affichage
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Contenu principal divisé en deux sections -->
    <div class="content d-flex flex-wrap mt-4 gap-3">
        <!-- Section Actualité -->
        <div class="actualites p-4 bg-white rounded flex-fill text-center shadow-sm">
            <h2>AFFICHAGE DE L'ACTUALITÉ</h2>
            <p>Contenu d'actualité ici...</p>
        </div>

        <!-- Section Événements à venir -->
        <div class="evenements p-4 bg-white rounded text-center shadow-sm" style="width: 300px;">
            <h2>ÉVÉNEMENTS À VENIR</h2>
            <p>Liste des événements à venir ici...</p>
        </div>
    </div>
</div>

<?php
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
