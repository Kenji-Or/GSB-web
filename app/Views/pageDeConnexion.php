<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="text-center mb-4">
                <img src="assets/images/logoGSB.svg" alt="Logo GSB" class="img-fluid" width="150">
            </div>

            <!-- Affichage du message d'erreur -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    // Utilisation de htmlspecialchars pour éviter les attaques XSS
                    echo htmlspecialchars($_SESSION['error']);
                    // Supprimer le message d'erreur après l'affichage
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=authentification" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <a href="index.php?action=forgotPassword" class="link-primary">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Se connecter</button>
            </form>
        </div>
    </div>

<?php
include "layouts/footer.html";
