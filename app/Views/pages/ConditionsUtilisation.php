<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container my-4 flex-grow-1">
    <!-- En-tête de la page -->
    <header class="mb-3">
        <div class="text-center py-5 text-black rounded shadow">
            <h1 class="fw-bold">Conditions d'utilisation de l'intranet</h1>
            <p class="lead mt-3">Découvrez les règles et responsabilités pour utiliser l'intranet de GSB de manière optimale.</p>
        </div>
    </header>

    <button onclick="history.back()" class="btn btn-outline-primary  mb-3">
        Retour
    </button>

    <!-- Contenu des conditions -->
    <main>
        <div class="row g-4">
            <!-- Condition 1 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">1. Objet des conditions d'utilisation</h5>
                    <p class="text-secondary">
                        Les présentes conditions définissent les modalités d'accès et d'utilisation de l'intranet de GSB. Elles visent à garantir un environnement sécurisé et professionnel.
                    </p>
                </div>
            </div>

            <!-- Condition 2 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">2. Accès et inscription</h5>
                    <p class="text-secondary">
                        L'accès est réservé aux utilisateurs autorisés disposant de droits spécifiques. Chaque utilisateur doit s'inscrire avec des informations exactes et maintenir la confidentialité de ses identifiants.
                    </p>
                </div>
            </div>

            <!-- Condition 3 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">3. Utilisation acceptable</h5>
                    <p class="text-secondary">
                        L'intranet doit être utilisé uniquement à des fins professionnelles, telles que l'accès aux ressources internes, formations et articles. Toute tentative de piratage ou de diffusion inappropriée est interdite.
                    </p>
                </div>
            </div>

            <!-- Condition 4 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">4. Responsabilité de l'utilisateur</h5>
                    <p class="text-secondary">
                        Chaque utilisateur est responsable des actions effectuées avec son compte. Partager des données sensibles en dehors de l'organisation est strictement interdit.
                    </p>
                </div>
            </div>

            <!-- Condition 5 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">5. Droits d'accès</h5>
                    <p class="text-secondary">
                        Les droits d'accès sont attribués en fonction des rôles utilisateurs. Toute tentative d'accès non autorisé sera immédiatement sanctionnée.
                    </p>
                </div>
            </div>

            <!-- Condition 6 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">6. Modification et suspension</h5>
                    <p class="text-secondary">
                        Galaxy Swiss Bourdin (GSB) se réserve le droit de modifier ces conditions ou de suspendre l'accès à l'intranet en cas de non-respect des règles établies.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include (BASE_PATH . '/App/Views/layouts/footer.php');
?>
