<?php
namespace App\Models;

use PDO;

class Contact {
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getAdminEmails() {
        $db = self::getDBConnection();
        $stmt = $db->prepare("SELECT email FROM users WHERE role_id = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}