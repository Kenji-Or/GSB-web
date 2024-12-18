<?php
namespace App\Models;
use PDO;

class Forum
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getAllForums()
    {
        $db = self::getDBConnection();
        $stmt = $db->query("SELECT forum.*, users.prenom FROM forum JOIN users ON forum.user_id = users.user_id ORDER BY date_creation DESC");
        $db=null;
        return $stmt->fetchAll();
    }

    public static function createForum($title, $userId) {
        $db = self::getDBConnection();
        $stmt = $db->prepare("INSERT INTO forum (titre_forum, user_id, date_creation) VALUES (:titre_forum, :user_id, :date_creation)");
        $stmt->bindParam(':titre_forum', $title, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':date_creation', date('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
        return $db->lastInsertId();
    }

    public static function addPermission($forumId, $user_id = null, $roleId = null)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("INSERT INTO forum_permission (forum_id, user_id, role_id) VALUES (:forum_id, :user_id, :role_id)");
        $stmt->bindParam(':forum_id', $forumId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
        $db=null;
    }

    public static function hasAccess($forumId, $userId, $roleId)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM forum_permission WHERE forum_id = :forum_id AND (user_id = :user_id OR role_id = :role_id)");
        $stmt->bindValue(':forum_id', $forumId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
        $db=null;
        return $stmt->fetchColumn() > 0;
    }

    public static function getAccessibleForum($userId, $roleId)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("SELECT DISTINCT t.*, users.prenom FROM forum t LEFT JOIN forum_permission tp ON t.id_forum = tp.forum_id LEFT JOIN users ON t.user_id = users.user_id WHERE tp.user_id = :user_id OR tp.role_id = :role_id ORDER BY t.date_creation DESC");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();
        $db=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteForum($id) {
        $db = self::getDBConnection();
        $stmt = $db->prepare("DELETE FROM forum WHERE id_forum = :id_forum");
        $stmt->bindValue(':id_forum', $id, PDO::PARAM_INT);
        $stmt->execute();
        $db=null;
    }
}