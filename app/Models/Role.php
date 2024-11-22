<?php
namespace App\Models;

use PDO;

class Role
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getAllRoles()
    {
        $db = self::getDBConnection();

        $stmt = $db->prepare("SELECT * FROM role");
        $stmt->execute();

        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
