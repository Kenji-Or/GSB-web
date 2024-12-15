<?php
namespace App\Models;

use PDO;
use \PDOException;
use \Exception;

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
        $query = $db->prepare("INSERT INTO users (prenom, nom, email, role_id, password_hash) VALUES (:prenom, :nom, :email, :role_id, :password_hash)");
        $query->bindParam(':email', $email);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':role_id', $role_id);
        $query->bindParam(':password_hash', $password_hash);
        $query->execute();

        $db= null;
    }

    public static function updateUser($fields, $params, $user_id)
    {
        try {
            $db = self::getDBConnection();

            // Construire la clause SET de manière dynamique
            $set_clause = implode(", ", $fields);

            // Ajouter la condition WHERE
            $query = $db->prepare("UPDATE users SET $set_clause WHERE user_id = :user_id");

            // Lier les paramètres
            foreach ($params as $key => $value) {
                $query->bindValue($key, $value);
            }
            $query->bindValue(':user_id', $user_id, PDO::PARAM_INT);

            // Exécuter la requête
            $query->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        } finally {
            $db = null;
        }
    }

    public static function updatePassword($userId, $password) {
        $db = self::getDBConnection();
        $stmt = $db->prepare('UPDATE users SET password_hash = :password_hash WHERE user_id = :user_id');
        $stmt->execute([
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'user_id' => $userId
        ]);
    }


    public static function deletingUser($user_id)
    {
        $db = self::getDBConnection();
        $query = $db->prepare("DELETE FROM users WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->execute();
        $db= null;
    }
}
