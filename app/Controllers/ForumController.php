<?php
namespace App\Controllers;

use App\Models\Forum;

class ForumController
{
    public function getAllForums()
    {
        return Forum::getAllForums();
    }

    public function createForum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['titre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $userId = htmlspecialchars(trim($_SESSION['user_id'] ?? ''), ENT_QUOTES, 'UTF-8');
            Forum::createForum($title, $userId);
            header('Location: index.php?action=listForum');
            exit();
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header("Location: index.php?action=listForum");
            exit;
        }

    }

    public function deleteForum($id)
    {
            if ($_SESSION['role'] === 1) {
                $idForum = htmlspecialchars(trim($id ?? null), ENT_QUOTES, 'UTF-8');
                Forum::deleteForum($idForum);
                $_SESSION['success'] = 'Sujet supprimé avec success !';
                header("Location: index.php?action=listForum");
                exit;
            } else {
                $_SESSION['error'] = 'Vous n\'avez pas l\'autorité suffisante pour faire cette action.';
                header('Location: index.php?action=listForum');
                exit();
            }
    }
}