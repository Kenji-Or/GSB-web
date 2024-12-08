<?php
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\RoleController;
use App\Controllers\DocumentController;
use App\Controllers\ArticleController;
use App\Controllers\EvenementController;
use App\Controllers\ForumController;
use App\Controllers\PostForumController;

$authController = new AuthController();
$userController = new UserController();
$roleController = new RoleController();
$documentController = new DocumentController();
$articleController = new ArticleController();
$evenementController = new EvenementController();
$forumController = new ForumController();
$postForumController = new PostForumController();

// Vérifie si une action est définie dans l'URL, sinon utilise une chaîne vide
$action = $_GET['action'] ?? "";
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
    },
    '/^deleteDocument\/(\d+)$/' => function($matches) use ($documentController) {
    $documentId = $matches[1];
    $documentController->deleteDocument($documentId);
    header('Location: index.php?action=documents');
    exit();
    },
    '/^viewArticle\/(\d+)$/' => function($matches) use ($articleController) {
    $articleId = $matches[1];
    $article = $articleController->getArticleById($articleId);
    include '../app/Views/pages/Article.php';
    exit();
    },
    '/^deletearticle\/(\d+)$/' => function($matches) use ($articleController) {
    $articleId = $matches[1];
    $articleController->deleteArticle($articleId);
    header('Location: index.php?action=actualites');
    exit();
    },
    '/^deleteEvent\/(\d+)$/' => function($matches) use ($evenementController) {
    $evenementId = $matches[1];
    $evenementController->deleteEvenement($evenementId);
    header('Location: index.php?action=listEvent');
    exit();
    },
    '/^deleteDiscussion\/(\d+)$/' => function($matches) use ($forumController) {
    $forumId = $matches[1];
    $forumController->deleteForum($forumId);
    header('Location: index.php?action=listForum');
    exit();
    }
];

$routeMatched = false;

foreach ($routes as $pattern => $callback) {
    if ($connected) {
        if (preg_match($pattern, $action, $matches)) {
            $routeMatched = true;
            $callback($matches); // Appelle la fonction associée à la route
            break;
        }
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
                $articles = $articleController->getLastArticles();
                $events = $evenementController->nextEvent();
                include '../app/Views/pages/Home.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'GestionAcces':
            if ($connected) {
                $users = $userController->listUsers();
                include '../app/Views/pages/GestionAcces.php';
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
            if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 1) {
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
                $documents = $documentController->searchDocumentByTitle();
                include '../app/Views/pages/listDocuments.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'createdocument':
            if ($connected) {
                include '../app/Views/pages/CreateDocument.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'creatingdocument':
            if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $documentController->createDocument();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case "view_file":
            if ($connected) {
                $file = $_GET['file'] ?? "";
                if (str_starts_with($file, 'image_')) {
                    $filePath = "uploads/img/$file";
                    if (file_exists($filePath)) {
                        $fileType = mime_content_type($filePath);
                        if (strpos($fileType, 'image/') === 0) {
                            // C'est une image
                            header("Content-Type: $fileType");
                            readfile($filePath);
                            exit();
                        } else {
                            echo "Fichier non trouvé.";
                        }
                    }
                } elseif (str_starts_with($file, 'document_')) {
                    $filePath = "uploads/img/$file";
                    if (file_exists($filePath)) {
                        header("Content-Type: application/pdf");
                        readfile($filePath);
                        exit();
                    } else {
                        echo "Fichier non trouvé.";
                    }
                }
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case "actualites":
            if ($connected) {
                // Appeler la méthode getArticles() en passant le numéro de page
                $articles = $articleController->getArticles();
                include '../app/Views/pages/listArticles.php';
            } else {
                // Si l'utilisateur n'est pas connecté, rediriger vers la page de login
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'createArticle':
            if($connected){
                include '../app/Views/pages/CreateArticle.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'creatingarticle':
            if($connected && $_SERVER['REQUEST_METHOD'] === 'POST'){
                $articleController->addArticle();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'listEvent':
            if ($connected) {
                $events = $evenementController->getAllEvenements();
                include '../app/Views/pages/listEvent.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'listForum':
            if ($connected) {
                $forum = $forumController->getAllForums();
                include '../app/Views/pages/Forum.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;


        case 'createevent':
            if($connected){
                include '../app/Views/pages/CreateEvent.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;


        case 'creatingevent':
            if($connected && $_SERVER['REQUEST_METHOD'] === 'POST'){
                $evenementController->createEvenement();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'createForum':
            if ($connected) {
                $roles = $roleController->listRoles();
                $users = $userController->listUsers();
                include '../app/Views/pages/CreateForum.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'creatingforum':
            if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST'){
                $forumController->createForum();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'forum':
            if ($connected) {
                $discussion = $postForumController->getPostForum();
                include '../app/Views/pages/DiscussionForum.php';
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'postforum':
            if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $postForumController->postPostForum();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;

        case 'deleteDiscussion':
            if ($connected) {
                $forumController->deleteForum();
            } else {
                header('Location: index.php?action=login');
                exit();
            }
            break;


        // Route par défaut pour les pages non trouvées
        default:
            http_response_code(404);
            include('../app/Views/pages/404.php');
            break;
    }
}
