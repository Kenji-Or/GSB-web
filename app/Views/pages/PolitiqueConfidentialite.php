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
            <h1 class="fw-bold">Politique de confidentialité et RGPD</h1>
        </div>
    </header>
    <!-- Bouton retour -->
    <button onclick="history.back()" class="btn btn-outline-primary  mb-3">
        <i class="bi bi-arrow-left"></i> Retour
    </button>
    <main>
        <div class="row g-4">
            <!-- Condition 1 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">1. Introduction</h5>
                    <p class="text-secondary">
                        Cette politique de confidentialité décrit comment GSB collecte, utilise, conserve et protège vos données personnelles conformément au RGPD (Règlement Général sur la Protection des Données).
                    </p>
                </div>
            </div>

            <!-- Condition 2 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">2. Données collectées</h5>
                    <ul class="text-secondary">
                        <li>Données collectées : nom, prénom, adresse e-mail professionnelle, rôle au sein de GSB, activité sur l'Intranet.</li>
                        <li>Données sensibles : données médicales incluses dans les protocoles (soumis à des mesures de protection renforcées).</li>
                    </ul>
                </div>
            </div>

            <!-- Condition 3 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">3. Finalités du traitement</h5>
                    <ul class="text-secondary">
                        <li>Gestion des accès et des droits utilisateur.</li>
                        <li>Accès aux formations, documents médicaux et calendrier d'événements.</li>
                        <li>Analyse des interactions pour améliorer les fonctionnalités de l'Intranet.</li>
                    </ul>
                </div>
            </div>

            <!-- Condition 4 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">4. Durée de conservation</h5>
                    <p class="text-secondary">
                        Les données personnelles sont conservées pendant la durée d'activité professionnelle au sein de Galaxy Swiss Bourdin (GSB) et supprimées après une période de 12 mois suivant la fin de la collaboration.
                    </p>
                </div>
            </div>

            <!-- Condition 5 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">5. Droits des utilisateurs</h5>
                    <p class="text-secondary">
                        Conformément au RGPD, vous disposez des droits suivants :
                    </p>
                    <ul class="text-secondary">
                        <li>Accès, rectification et suppression de vos données.</li>
                        <li>Opposition ou limitation au traitement.</li>
                        <li>Portabilité des données.</li>
                    </ul>
                    <p class="text-secondary">Pour exercer ces droits, contactez-nous à kenjiogier@gmail.com.</p>
                </div>
            </div>

            <!-- Condition 6 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">6. Sécurité des données</h5>
                    <p class="text-secondary">
                        GSB met en place des mesures techniques et organisationnelles pour protéger les données contre tout accès non autorisé, perte ou altération.
                    </p>
                </div>
            </div>

            <!-- Condition 7 -->
            <div class="col-lg-6">
                <div class="p-4 bg-light border rounded-3 shadow-sm">
                    <h5 class="fw-bold text-primary mb-3">7. Partage des données</h5>
                    <p class="text-secondary">
                        Les données ne sont partagées qu'avec des partenaires contractuels dans le cadre de besoins strictement définis et avec votre consentement préalable.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
include (BASE_PATH . '/App/Views/layouts/footer.php');