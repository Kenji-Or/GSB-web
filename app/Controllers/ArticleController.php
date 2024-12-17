<?php
namespace App\Controllers;
use App\Models\Article;

class ArticleController {
    public function getArticles() {
        return Article::getArticles();
    }

    public function getArticleById($id) {
        return Article::getArticleById($id);
    }

    public function getLastArticles()
    {
        return Article::getLastArticle();
    }

    public function addArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_SESSION['role'] === 1 || $_SESSION['role'] === 2)) {
            // Nettoyage des entrées utilisateur
            $titre = htmlspecialchars(trim($_POST['titre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $contenu = htmlspecialchars(trim($_POST['contenu'] ?? ''), ENT_QUOTES, 'UTF-8');
            $auteur = htmlspecialchars(trim($_POST['auteur'] ?? ''), ENT_QUOTES, 'UTF-8');
            $file = $_FILES['image'] ?? null;

            if ($file === null) {
                $_SESSION['error'] = "Fichier image manquant";
                header("Location: index.php?action=createArticle");
                exit();
            }

            // Dossier de destination
            $uploadDir = "uploads/img/";

            // Validation des champs obligatoires
            if (empty($titre) || empty($auteur) || empty($contenu)) {
                $_SESSION['error'] = "Un des champs n'est pas remplis.";
                header("Location: index.php?action=createarticle");
                exit();
            }

            // Validation du fichier
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $originalName = $file['name'];
                $fileType = mime_content_type($file['tmp_name']);
                $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                // Validation du type MIME et de l'extension
                if (str_starts_with($fileType, 'image/') && in_array($fileExtension, $allowedExtensions)) {
                    // Génération d'un nom unique
                    $uniqueFileName = uniqid('image_', true) . "." . $fileExtension;
                    $filePath = $uploadDir . $uniqueFileName;

                    // Déplacement du fichier vers le dossier cible
                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        $filePath = "index.php?action=view_image&file=" . $uniqueFileName;
                        // Ajout dans la base de données
                        Article::addArticle($titre, $contenu, $auteur, $filePath);
                        $_SESSION['success'] = "Article créé avec succès.";
                        header("Location: index.php?action=actualites");
                        exit;
                    } else {
                        $_SESSION['error'] = "Erreur lors de l'upload.";
                        header("Location: index.php?action=createArticle");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Seuls les fichiers image sont autorisés.";
                    header("Location: index.php?action=createArticle");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Erreur lors de l'upload du fichier.";
                header("Location: index.php?action=createArticle");
                exit;
            }
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header("Location: index.php?action=createArticle");
            exit;
        }
    }

    public function deleteArticle($id)
    {
        if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
            $article = Article::getArticleById($id);
            if ($article && isset($article['image'])) {
                // Extraire le nom du fichier à partir du paramètre 'file'
                parse_str(parse_url($article['image'], PHP_URL_QUERY), $queryParams);
                if (isset($queryParams['file'])) {
                    $fileName = $queryParams['file'];

                    // Construire le chemin absolu du fichier
                    $filePath = 'uploads/img/' . $fileName;

                    // Vérifier si le fichier existe
                    if (file_exists($filePath)) {
                        // Supprimer le fichier du disque
                        if (unlink($filePath)) {
                            // Appeler la méthode pour supprimer l'enregistrement dans la base de données
                            Article::deleteArticle($id);

                            $_SESSION['success'] = "Article supprimé avec succès.";
                        } else {
                            $_SESSION['error'] = "Une erreur est survenue lors de la suppression du fichier.";
                        }
                    } else {
                        $_SESSION['error'] = "Le fichier n'existe pas sur le serveur.";
                    }
                } else {
                    $_SESSION['error'] = "Le paramètre de fichier est manquant ou incorrect.";
                }
            } else {
                $_SESSION['error'] = "Le fichier n'existe pas ou l'ID est invalide.";
            }
        } else {
            $_SESSION['error'] = "Vous n'avez pas l'autorité suffisante pour faire cette action.";
        }
    }
}
