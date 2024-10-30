<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?action=home"><img src="assets/images/logoGSB.svg" alt="logo" width="100"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNav">
            <ul class="navbar-nav d-flex justify-content-between w-100">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=document">Documents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=actualites">Actualités et annonces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=forum">Forum</a>
                </li>
                <?php
                if(($_SESSION["role"] === "admin")){
                    ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=GestionAcces">Gestion des accès</a>
                </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=support">Support technique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=contact">Contact</a>
                </li>
                <li class="nav-item">
                    <form action="index.php?action=logout" method="POST" style="display: inline;">
                        <button type="submit" class="nav-link text-white">Se déconnecter</button>
                    </form>
                </li>
                <!-- Ajoutez d'autres liens ici selon les besoins -->
            </ul>
        </div>
    </div>
</nav>