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
        $stmt = $db->prepare('SELECT * FROM documents WHERE nom_document LIKE :nom_document COLLATE utf8_general_ci;');
        // Utilisation de LIKE pour une recherche partielle
        $stmt->bindValue(':nom_document', '%' . $title . '%', PDO::PARAM_STR);
        $stmt->execute();
        $db=null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function add($title, $auteur, $path)
    {
        // Connexion à la base de données
        $db = self::getDBConnection();

        // Préparation de la requête d'insertion dans la table 'documents'
        $stmt = $db->prepare('INSERT INTO documents (nom_document, auteur, date_creation, document_pdf) VALUES (:nom_document, :auteur, :date_creation, :document_pdf)');

        // Lier les valeurs aux paramètres de la requête préparée
        $stmt->bindValue(':nom_document', $title, PDO::PARAM_STR);  // Lier le titre du document
        $stmt->bindValue(':auteur', $auteur, PDO::PARAM_STR);        // Lier l'auteur du document
        $stmt->bindValue(':date_creation', date('Y-m-d'), PDO::PARAM_STR);  // Lier la date actuelle de création
        $stmt->bindValue(':document_pdf', $path, PDO::PARAM_STR);     // Lier le chemin du fichier PDF

        // Exécution de la requête
        $stmt->execute();

        // Fermer la connexion à la base de données
        $db = null;
    }

    static function delete($id)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('DELETE FROM documents WHERE id_document = :id_document');
        $stmt->execute(['id_document' => $id]);
        $db = null;
    }

}