<?php

namespace App\Models;

use PDO;
use PDOException;

class Article {
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }

    public static function getArticles($page = 1, $articlesParPage = 10)
    {
        $db = self::getDBConnection();
        $offset = ($page - 1) * $articlesParPage;
        $query = "SELECT * FROM articles ORDER BY date_publication DESC LIMIT :offset, :limit";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $articlesParPage, PDO::PARAM_INT);
        $stmt->execute();
        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour obtenir le nombre total d'articles pour calculer le nombre de pages
    public static function getTotalArticles() {
        $db = self::getDBConnection();
        $stmt = $db->query("SELECT COUNT(*) FROM articles");
        return $stmt->fetchColumn();
    }

    public static function getArticleById($id) {
        $db = self::getDBConnection();
        $query = "SELECT * FROM articles WHERE id_article = :id_article";
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
        $stmt->bindValue(':auteur', $auteur, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        $stmt->bindValue(':date_publication', date('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
    }
}