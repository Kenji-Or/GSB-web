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
        return $stmt->fetchAll();
    }

    public static function createForum($title, $userId) {
        $db = self::getDBConnection();
        $stmt = $db->prepare("INSERT INTO forum (titre_forum, user_id, date_creation) VALUES (:titre_forum, :user_id, :date_creation)");
        $stmt->bindValue(':titre_forum', $title);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':date_creation', date('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function deleteForum($id) {
        $db = self::getDBConnection();
        $stmt = $db->prepare("DELETE FROM forum WHERE id_forum = :id_forum");
        $stmt->bindValue(':id_forum', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}