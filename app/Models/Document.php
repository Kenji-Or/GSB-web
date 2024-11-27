<?php
namespace App\Models;

use PDO;

class Document
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }
    static function getAll()
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('SELECT * FROM documents');
        $stmt->execute();
        $db=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getById($id)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('SELECT * FROM documents WHERE id_document = :id_document');
        $stmt->execute(['id_document' => $id]);
        $db = null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function getByTitle($title)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('SELECT * FROM documents WHERE nom_document = :nom_document');
        $stmt->execute(['nom_document' => $title]);
        $db=null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}