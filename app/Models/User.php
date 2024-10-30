<?php
namespace App\Models;

use PDO;

class User
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function findByEmail($email)
    {
        // Obtenir la connexion à la base de données via la configuration
        $db = self::getDBConnection();

        // Préparer la requête pour chercher l'utilisateur par email
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        // Retourner les résultats
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
