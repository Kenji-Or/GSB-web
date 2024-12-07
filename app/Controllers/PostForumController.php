<?php
namespace App\Controllers;

use App\Models\PostForum;

class PostForumController {
    public function getPostForum() {
        $forumId = $_GET['forum_id'] ?? null;

        if (!$forumId) {
            $_SESSION['error'] = 'Erreur lors du chargement du forum';
            header('location: index.php?action=forum');
            exit;
        }

        return PostForum::getPostsByForum($forumId);
    }

    public function postPostForum() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = htmlspecialchars(trim($_POST['content'] ?? ''), ENT_QUOTES, 'UTF-8');
            $forumId = htmlspecialchars(trim($_POST['forum_id'] ?? ''), ENT_QUOTES, 'UTF-8');
            $userId = htmlspecialchars(trim($_SESSION['user_id'] ?? ''), ENT_QUOTES, 'UTF-8');

            if (PostForum::createPost($content, $forumId, $userId)) {
                header('location: index.php?action=forum&forum_id=' . $forumId);
            } else {
                $_SESSION['error'] = 'Erreur lors du chargement des messages du forum';
                header('location: index.php?action=listForum');
                exit;
            }
        }
    }
}