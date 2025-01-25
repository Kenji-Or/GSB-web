<?php
namespace App\Controllers;

use App\Models\PostForum;

class PostForumController {
    public function getPostForum() {
        $forumId = $_GET['forum_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;
        $roleId = $_SESSION['role'] ?? null;

        if (!$forumId) {
            $_SESSION['error'] = 'Erreur lors du chargement du forum';
            header('location: index.php?action=listForum');
            exit;
        }

        if (PostForum::getPostsByForum($forumId, $userId, $roleId) === null) {
            $_SESSION['error'] = "Vous n'avez pas l'autorisation d'accéder à ce forum.";
            header('location: index.php?action=listForum');
            exit;
        }
        return PostForum::getPostsByForum($forumId, $userId, $roleId);
    }

    public function postPostForum() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $forumId = trim($_POST['forum_id'] ?? '');
            $userId = trim($_SESSION['user_id'] ?? '');
            $roleId = trim($_SESSION['role'] ?? '');

            if (!empty($content) && !empty($forumId) && !empty($userId)) {
                if (PostForum::createPost($content, $forumId, $userId, $roleId)) {
                    header('location: index.php?action=forum&forum_id=' . $forumId);
                } else {
                    $_SESSION['error'] = "Vous n'avez pas l'autorisation de publier dans ce forum.";
                    header('location: index.php?action=listForum');
                    exit;
                }
            }
        }
    }
}