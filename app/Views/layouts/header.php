<?php // Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Ajouter Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .bg-navbar {
            background-color: #7298C8;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-navbar mb-4 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?action=home"><img src="assets/images/logoGSB.svg" alt="logo" width="100"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNav">
            <ul class="navbar-nav d-flex justify-content-between w-100">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=documents">Documents</a>
                </li>
                <li class="nav-item dropdown">
                    <button class="nav-link dropdown-toggle text-white" id="deroulanta" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actualités et Évènements
                    </button>
                    <div class="dropdown-menu dropdown-menu" aria-labelledby="deroulanta">
                        <a class="dropdown-item" href="index.php?action=actualites">Actualités</a>
                        <a class="dropdown-item" href="index.php?action=listEvent">Évènements</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=listForum">Forum</a>
                </li>
                <?php
                if(($_SESSION["role"] === 1)){
                    ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=GestionAcces">Gestion des accès</a>
                </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=contact">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <button class="nav-link dropdown-toggle text-white" id="deroulanta" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deroulanta">
                        <a class="dropdown-item" href="index.php?action=profile/<?php echo $_SESSION['user_id']; ?>">Mon Profile</a>
                        <form action="index.php?action=logout" method="POST" style="display: inline;">
                            <button type="submit" class="dropdown-item">Se déconnecter</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php if (isset($_SESSION['success'])): ?>
    <div id="success-alert" class="alert alert-success mb-3 position-fixed top-0 end-0" style="max-width: 300px; z-index: 1150; margin-top: 100px;">
        <?php
        // Utilisation de htmlspecialchars pour éviter les attaques XSS
        echo htmlspecialchars($_SESSION['success']);
        unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div id="danger-alert" class="alert alert-danger mb-3 position-fixed top-0 end-0" style="max-width: 300px; z-index: 1150; margin-top: 100px;">
        <?php
        // Utilisation de htmlspecialchars pour éviter les attaques XSS
        echo htmlspecialchars($_SESSION['error']);
        unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Trouver l'alerte par son ID
        var successAlert = document.getElementById("success-alert");

        // Si l'alerte existe, configurer un délai pour la suppression
        if (successAlert) {
            setTimeout(function() {
                // Appliquer une transition de disparition
                successAlert.style.transition = "opacity 0.5s";
                successAlert.style.opacity = "0";

                // Supprimer l'élément après la transition
                setTimeout(function() {
                    successAlert.remove();
                }, 500); // Correspond à la durée de la transition
            }, 10000); // Délai de 10 secondes
        }
    });
</script>
