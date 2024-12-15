<?php
namespace App\Models;
use PDO;

class PasswordReset{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function storeToken($userId, $token){
        $db = self::getDBConnection();
        $stmt = $db->prepare('DELETE FROM password_reset WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);

        $stmt = $db->prepare('INSERT INTO password_reset (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)');

        $stmt->execute(['user_id' => $userId, 'token' => $token, 'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))]);
    }

    public static function findByToken($token) {
        $db = self::getDBConnection();

        $stmt = $db->prepare('SELECT * FROM password_reset WHERE token = :token');
        $stmt->execute(['token' => $token]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteToken($userId) {
        $db = self::getDBConnection();

        $stmt = $db->prepare('DELETE FROM password_reset WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
    }
}