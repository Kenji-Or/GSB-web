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

        $db= null;
        // Retourner les résultats
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById($user_id)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("SELECT users.*, role.role FROM users INNER JOIN role ON users.role_id = role.id_role WHERE user_id = :user_id");
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();

        $db= null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllUsers()
    {
        $db = self::getDBConnection();

        $stmt = $db->prepare("SELECT users.*, role.role FROM users INNER JOIN role ON users.role_id = role.id_role");
        $stmt->execute();

        $db= null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addUser($email, $prenom, $nom, $role_id, $password_hash)
    {
        // Préparer la requête SQL et lier les paramètres
        $db = self::getDBConnection();
        $query = $db->prepare("INSERT INTO Users (prenom, nom, email, role_id, password_hash) VALUES (:prenom, :nom, :email, :role_id, :password_hash)");
        $query->bindParam(':email', $email);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':role_id', $role_id);
        $query->bindParam(':password_hash', $password_hash);
        $query->execute();

        $db= null;
    }

    public static function updateUser($user_id, $email, $prenom, $nom, $role_id, $password_hash)
    {
        $db = self::getDBConnection();
        $query = $db->prepare("UPDATE Users SET email = :email, prenom = :prenom, nom = :nom, role_id = :role_id, password_hash = :password_hash WHERE user_id = :user_id");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if ($password_hash !== null) {
            $query->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        }

        $query->execute();

        $db= null;
    }

    public static function deletingUser($user_id)
    {
        $db = self::getDBConnection();
        $query = $db->prepare("DELETE FROM Users WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();
        $db= null;
    }
}
