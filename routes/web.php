<?php
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\RoleController;
use App\Controllers\DocumentController;

$authController = new AuthController();
$userController = new UserController();
$roleController = new RoleController();
$documentController = new DocumentController();

// Vérifie si une action est définie dans l'URL, sinon utilise une chaîne vide
$action = isset($_GET['action']) ? $_GET['action'] : "";
$connected = isset($_SESSION['nom']) ? true : false;

$routes = [
    '/^edit\/(\d+)$/' => function($matches) use ($userController, $roleController) {
        $userId = $matches[1];
        $user = $userController->editUser($userId);
        $roles = $roleController->listRoles();
        include '../app/Views/pages/editUser.php';
    },
    '/^updateUser\/(\d+)$/' => function($matches) use ($userController) {
        $userId = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updateUser($userId);
            if ($_SESSION['role'] === 'admin') {
                header('Location: index.php?action=GestionAcces');
                exit();
            } else {
                header('Location: index.php?action=home');
                exit();
            }
        } else {
            http_response_code(405);
            echo "Méthode non autorisée.";
        }
    },
     '/^delete\/(\d+)$/' => function($matches) use ($userController) {
         $userId = $matches[1];
         $userController->deleteUser($userId);
         header('Location: index.php?action=home');
         exit();
    },
    '/^profile\/(\d+)$/' => function($matches) use ($userController, $roleController) {
        $userId = $matches[1];
        $user = $userController->editUser($userId);
        $roles = $roleController->listRoles();
        include '../app/Views/pages/profile.php';
        exit();
    },
    '/^document\/(\d+)$/' => function($matches) use ($documentController) {
        $documentId = $matches[1];
        $document = $documentController->getDocument($documentId);
        include '../app/Views/pages/document.php';
        exit();
    }
];

$routeMatched = false;

foreach ($routes as $pattern => $callback) {
    if (preg_match($pattern, $action, $matches)) {
        $routeMatched = true;
        $callback($matches); // Appelle la fonction associée à la route
        break;
    }
}
if (!$routeMatched) {
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
            if ($connected) {
                include '../app/Views/pages/Home.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'GestionAcces':
            if ($connected) {
                $userController->listUsers();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'createUser':
            if ($connected) {
                $roles = $roleController->listRoles();
                include '../app/Views/pages/CreateUser.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'creatinguser':
            if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $userController->addingUser();
            } else {
                http_response_code(405);
                echo "Méthode non autorisée.";
            }
            break;

        case 'documents':
            if ($connected) {
                $documents = $documentController->getAllDocuments();
                include '../app/Views/pages/listDocuments.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'searchdocument':
            if ($connected) {
                $document = $documentController->searchDocumentByTitle();
                include '../app/Views/pages/document.php';
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
}
