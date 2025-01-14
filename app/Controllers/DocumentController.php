<?php
namespace App\Controllers;
use App\Models\Document;

class DocumentController {
    public function getAllDocuments()
    {
        return Document::getAll();
    }

    public function getDocument($id)
    {
        return Document::getById($id);
    }

    public function searchDocumentByTitle()
    {
        $title = htmlspecialchars(trim($_POST['search'] ?? ''), ENT_QUOTES, 'UTF-8');
        if (!$title) {
            return Document::getAll();
        }
        return Document::getByTitle($title);
    }

    public function createDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 1) {
            // Nettoyage des entrées utilisateur
            $titre = htmlspecialchars(trim($_POST['titre'] ?? ''), ENT_QUOTES, 'UTF-8');
            $auteur = htmlspecialchars(trim($_SESSION['user_id'] ?? ''), ENT_QUOTES, 'UTF-8');
            $file = $_FILES['file'] ?? null;

            if ($file === null) {
                $_SESSION['error'] = "Fichier PDF manquant";
                header("Location: index.php?action=createdocument");
                exit();
            }

            // Dossier de destination
            $uploadDir = "uploads/PDF/";

            // Validation des champs obligatoires
            if (empty($titre) || empty($auteur)) {
                $_SESSION['error'] = "Titre et auteur sont obligatoires.";
                header("Location: index.php?action=createdocument");
                exit();
            }

            // Validation du fichier
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $originalName = $file['name'];
                $fileType = mime_content_type($file['tmp_name']);
                $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                // Validation du type MIME et de l'extension
                if ($fileType === 'application/pdf' && $fileExtension === 'pdf') {
                    // Génération d'un nom unique
                    $uniqueFileName = uniqid('document_', true) . ".pdf";
                    $filePath = $uploadDir . $uniqueFileName;

                    // Déplacement du fichier vers le dossier cible
                    if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        $filePath = "index.php?action=view_file&file=" . $uniqueFileName;
                        // Ajout dans la base de données
                        Document::add($titre, $auteur, $filePath);
                        $_SESSION['success'] = "Document ajouté avec succès.";
                        header("Location: index.php?action=documents");
                        exit;
                    } else {
                        $_SESSION['error'] = "Erreur lors de l'upload.";
                        header("Location: index.php?action=createdocument");
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Seuls les fichiers PDF sont autorisés.";
                    header("Location: index.php?action=createdocument");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Erreur lors de l'upload du fichier.";
                header("Location: index.php?action=createdocument");
                exit;
            }
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header("Location: index.php?action=createdocument");
            exit;
        }
    }

    public function deleteDocument($id)
    {
        if ($_SESSION['role'] === 1) {
        $document = Document::getById($id);
        if ($document && isset($document['document_pdf'])) {
            // Extraire le nom du fichier à partir du paramètre 'file'
            parse_str(parse_url($document['document_pdf'], PHP_URL_QUERY), $queryParams);

            if (isset($queryParams['file'])) {
                $fileName = $queryParams['file'];

                // Construire le chemin absolu du fichier
                $filePath = 'uploads/PDF/' . $fileName;

                // Vérifier si le fichier existe
                if (file_exists($filePath)) {
                    // Supprimer le fichier du disque
                    if (unlink($filePath)) {
                        // Appeler la méthode pour supprimer l'enregistrement dans la base de données
                        Document::delete($id);

                        $_SESSION['success'] = "Document supprimé avec succès.";
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
