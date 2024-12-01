<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 404 - Page non trouvée</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-page {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #f8f9fa;
        }
        .error-message {
            max-width: 600px;
        }
    </style>
</head>
<body>
<div class="error-page">
    <div class="error-message">
        <h1 class="display-1 text-danger">404</h1>
        <h2 class="mb-4">Oups! La page que vous recherchez est introuvable.</h2>
        <p>Il semble que la page que vous cherchez n'existe plus ou a été déplacée. Essayez de revenir à la page d'accueil.</p>
        <a href="index.php?action=home" class="btn btn-primary">Retour à l'accueil</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<footer class="text-center py-1">
    <div class="container">
        <p>&copy; 2024 GSB. Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>
