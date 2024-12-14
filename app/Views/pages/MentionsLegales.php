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
            <h1 class="fw-bold">Mentions légales</h1>
        </div>
    </header>
    <div class="d-flex justify-content-around">
    <!-- Bouton retour -->
    <button onclick="history.back()" class="btn btn-outline-primary  mb-3">
        Retour
    </button>
    <a href="index.php?action=politiqueConfidentialite">
        <button class="btn btn-outline-primary  mb-3">
            Politique de Confidentialité
        </button>
    </a>
        <a href="index.php?action=conditionUtilisation">
            <button class="btn btn-outline-primary  mb-3">
                Conditions d'utilisation
            </button>
        </a>
    </div>
    <main>
        <div class="row g-4">
            <!-- Condition 1 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">1. Éditeur du site</h5>
                    <ul class="text-secondary">
                        <li>Nom de l'organisation : Galaxy Swiss Bourdin</li>
                        <li>E-mail : accueil@swiss-galaxy.com</li>
                    </ul>
                </div>
            </div>

            <!-- Condition 2 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">2. Hébergement</h5>
                    <ul class="text-secondary">
                        <li>Nom de l'hébergeur : [Nom de l'hébergeur]</li>
                        <li>Adresse : [Adresse complète de l'hébergeur]</li>
                    </ul>
                </div>
            </div>

            <!-- Condition 3 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">3. Propriété intellectuelle</h5>
                    <p class="text-secondary">
                        Tous les contenus présents sur l'Intranet (textes, images, vidéos, documents, etc.) sont la propriété exclusive de GSB ou de leurs auteurs respectifs. Toute reproduction ou distribution non autorisée est interdite.
                    </p>
                </div>
            </div>

            <!-- Condition 4 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">4. Limitation de responsabilité</h5>
                    <p class="text-secondary">
                        GSB ne saurait être tenu responsable des dommages directs ou indirects résultant de l'utilisation de l'Intranet, y compris la perte de données ou les interruptions de service.
                    </p>
                </div>
            </div>

            <!-- Condition 5 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">5. Loi applicable</h5>
                    <p class="text-secondary">
                        L'utilisation de l'Intranet est soumise aux lois françaises. En cas de litige, les tribunaux seront compétents.
                    </p>
                </div>
            </div>

            <!-- Condition 6 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">6. Contact</h5>
                    <p class="text-secondary">
                        Pour toute question ou réclamation concernant l'Intranet, contactez-nous via la page "Contact" ou à l'adresse suivante : kenjiogier@gmail.com.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include (BASE_PATH . '/App/Views/layouts/footer.php');