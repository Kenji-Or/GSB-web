<?php

namespace App\Models;

use PDO;

class Article {
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getArticles()
    {
        $db = self::getDBConnection();
        $query = "SELECT articles.*, users.prenom, users.nom FROM articles JOIN users ON articles.auteur = users.user_id ORDER BY date_publication";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getLastArticle()
    {
        $db = self::getDBConnection();
        $query = "SELECT articles.*, users.prenom, users.nom FROM articles JOIN users ON articles.auteur = users.user_id ORDER BY date_publication DESC LIMIT 3";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getArticleById($id) {
        $db = self::getDBConnection();
        $query = "SELECT articles.*, users.prenom, users.nom FROM articles JOIN users ON articles.auteur = users.user_id WHERE id_article = :id_article";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_article', $id, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function addArticle($titre, $contenu, $auteur, $image)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare("INSERT INTO articles (titre, contenu, auteur, image, date_publication) VALUES (:titre, :contenu, :auteur, :image, :date_publication)");
        $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindValue(':contenu', $contenu, PDO::PARAM_STR);
        $stmt->bindValue(':auteur', $auteur, PDO::PARAM_INT);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':date_publication', date('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
    }

    public static function deleteArticle($id) {
        $db = self::getDBConnection();
        $stmt = $db->prepare("DELETE FROM articles WHERE id_article = :id_article");
        $stmt->bindValue(':id_article', $id, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
    }
}