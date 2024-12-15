<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Réinitialiser votre mot de passe</h2>

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

    <!-- Formulaire de réinitialisation du mot de passe -->
    <?php if(isset($token)) { ?>
    <form method="POST" action="index.php?action=newpassword&token=<?= htmlspecialchars(trim($token)) ?>" class="mt-4">
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre nouveau mot de passe" required>
        </div>
        <!--<div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmez votre nouveau mot de passe" required>
        </div>-->
        <button type="submit" class="btn btn-primary w-100">Changer le mot de passe</button>
    </form>
    <?php } ?>
</div>

<!-- Bootstrap JS et dépendances -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0o9d3u7L6gh9oDlmwO4lXx02RYQzFu4ztRIwH7DD1xyfZrgp" crossorigin="anonymous"></script>
</body>
</html>