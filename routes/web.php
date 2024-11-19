<?php
// routes/web.php

use App\Controllers\AuthController;

$authController = new AuthController();

// Vérifie si une action est définie dans l'URL, sinon utilise une chaîne vide
$action = isset($_GET['action']) ? $_GET['action'] : "";

// Gestion des différentes routes
switch ($action) {
    // Afficher le formulaire de connexion (GET)
    case 'login':
        include '../app/Views/pages/pageDeConnexion.php';
        break;

    // Gérer la connexion (POST)
    case 'authentification':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            http_response_code(405);
            echo "Méthode non autorisée.";
        }
        break;

    // Déconnexion (GET)
    case 'logout':
        $authController->logout();
        break;

    // Page d'accueil (GET) avec vérification de la session
    case 'home':
        if (isset($_SESSION['nom'])) {
            include '../app/Views/pages/Home.php';
        } else {
            header('Location: index.php?action=login');
            exit();
        }
        break;

    case 'GestionAcces':
        if (isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
            include '../app/Views/pages/GestionUsers.php';
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] != "admin") {
            http_response_code(404);
            echo "Vous n'avez pas les autorités suffisante";
            break;
        } else {
            header('Location: index.php?action=login');
            exit();
        }
        break;

    // Route par défaut pour les pages non trouvées
    default:
        http_response_code(404);
        echo "Page non trouvée.";
        break;
}
