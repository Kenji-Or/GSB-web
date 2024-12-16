<?php
namespace App\Controllers;

use App\Models\Forum;

class ForumController
{
    public function getAllForums()
    {
        $userId = $_SESSION['user_id'] ?? null;
        $roleId = $_SESSION['role'] ?? null;

        if ($userId && $roleId) {
            return Forum::getAccessibleForum($userId, $roleId);
        } else {
            $_SESSION['error'] = "Vous devez être connecté pour accéder aux forums.";
            header('Location: index.php?action=login');
            exit();
        }
    }

    public function createForum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['titre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $userId = $_SESSION['user_id'] ?? null;

            if (!$title || !$userId) {
                $_SESSION['error'] = "Titre ou utilisateur invalide.";
                header("Location: index.php?action=createForum");
                exit;
            }

            // Créer le forum
            $forumId = Forum::createForum($title, $userId);

            // Ajouter les permissions pour les rôles sélectionnés
            $roles = $_POST['roles'] ?? [];
            foreach ($roles as $roleId) {
                Forum::addPermission($forumId, null, htmlspecialchars($roleId, ENT_QUOTES, 'UTF-8'));
            }

            // Ajouter les permissions pour les utilisateurs spécifiques
            $users = $_POST['users'] ?? [];
            foreach ($users as $specificUserId) {
                Forum::addPermission($forumId, htmlspecialchars($specificUserId, ENT_QUOTES, 'UTF-8'), null);
            }

            $_SESSION['success'] = "Forum créé avec succès.";
            header('Location: index.php?action=listForum');
            exit();
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header("Location: index.php?action=listForum");
            exit();
        }
    }

    public function deleteForum($id)
    {
        if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { // Vérifie si l'utilisateur est admin
            $idForum = htmlspecialchars(trim($id ?? null), ENT_QUOTES, 'UTF-8');
            if (!$idForum) {
                $_SESSION['error'] = "Forum invalide.";
                header("Location: index.php?action=listForum");
                exit();
            }

            // Supprimer le forum (et les permissions liées via ON DELETE CASCADE)
            Forum::deleteForum($idForum);

            $_SESSION['success'] = 'Forum supprimé avec succès.';
            header("Location: index.php?action=listForum");
            exit;
        } else {
            $_SESSION['error'] = "Vous n'avez pas l'autorité suffisante pour effectuer cette action.";
            header('Location: index.php?action=listForum');
            exit();
        }
    }
}