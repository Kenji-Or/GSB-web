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

    public static function getPostsByForum($forumId, $userId, $roleId)
    {
        $db = self::getDBConnection();
        // Vérifier si l'utilisateur a le droit d'accéder au forum
        $stmt = $db->prepare("
        SELECT COUNT(*) 
        FROM forum_permission tp 
        WHERE (tp.user_id = :user_id OR tp.role_id = :role_id) 
        AND tp.forum_id = :forum_id
    ");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':role_id', $roleId);
        $stmt->bindValue(':forum_id', $forumId);
        $stmt->execute();

        // Si l'utilisateur n'a pas de permission, empêcher l'accès aux messages
        if ($stmt->fetchColumn() == 0) {
            return null;
        }

        $stmt = $db->prepare("SELECT post_forum.*, users.prenom FROM post_forum JOIN users ON post_forum.user_id = users.user_id WHERE forum_id = :forum_id ORDER BY date_creation ASC");
        $stmt->execute(['forum_id' => $forumId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createPost($content, $forumId, $userId, $roleId)
    {
        $db = self::getDBConnection();

        // Vérification des permissions de l'utilisateur pour publier dans ce forum
        $stmt = $db->prepare("
        SELECT COUNT(*) 
        FROM forum_permission tp 
        WHERE (tp.user_id = :user_id OR tp.role_id = :role_id) 
        AND tp.forum_id = :forum_id
    ");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':role_id', $roleId);
        $stmt->bindValue(':forum_id', $forumId);
        $stmt->execute();

        // Si l'utilisateur n'a pas de permission, empêcher l'ajout du message
        if ($stmt->fetchColumn() == 0) {
            return null;
        }

        $stmt = $db->prepare("INSERT INTO post_forum (content, forum_id, user_id, date_creation) VALUES (:content, :forum_id, :user_id, :date_creation)");
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':forum_id', $forumId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        date_default_timezone_set('Europe/Paris');
        $stmt->bindParam(':date_creation', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}