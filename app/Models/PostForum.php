<?php
namespace App\Models;

use PDO;

class PostForum
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getPostsByForum($forumId)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("SELECT post_forum.*, users.prenom FROM post_forum JOIN users ON post_forum.user_id = users.user_id WHERE forum_id = :forum_id ORDER BY date_creation ASC");
        $stmt->execute(['forum_id' => $forumId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createPost($content, $forumId, $userId)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("INSERT INTO post_forum (content, forum_id, user_id, date_creation) VALUES (:content, :forum_id, :user_id, :date_creation)");
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':forum_id', $forumId);
        $stmt->bindValue(':user_id', $userId);
        date_default_timezone_set('Europe/Paris');
        $stmt->bindValue(':date_creation', date("Y-m-d H:i:s"));
        $stmt->execute();
        return true;
    }
}