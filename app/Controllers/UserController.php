<?php
namespace App\Controllers;
use App\Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class UserController
{
    public function listUsers() {
        return User::getAllUsers();
    }

    public function editUser($id)
    {
        return User::findById($id);
    }

    public function addingUser()
    {
        // Générer un mot de passe aléatoire
        function genererMotDePasse($longueur = 12)
        {
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
            $motDePasse = '';
            $maxIndex = strlen($caracteres) - 1;
            for ($i = 0; $i < $longueur; $i++) {
                $motDePasse .= $caracteres[random_int(0, $maxIndex)];
            }
            return $motDePasse;
        }

        try {
            // Vérifier si l'utilisateur connecté a le rôle 'admin' (role_id = 1)
            $current_user_role_id = $_SESSION['role'] ?? null; // Supposons que le rôle est stocké dans la session.
            if ($current_user_role_id !== 1) {
                $_SESSION['error'] = "Vous n'avez pas les droits nécessaires pour créer un utilisateur.";
                header("Location: index.php?action=GestionAcces");
                exit();
            }

            // Vérifier que la méthode de la requête est POST
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $motDePasse = genererMotDePasse();
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''), ENT_QUOTES, 'UTF-8');
                $nom = htmlspecialchars(trim($_POST['nom'] ?? ''), ENT_QUOTES, 'UTF-8');
                $role_id = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_NUMBER_INT);
                $password_hash = password_hash($motDePasse, PASSWORD_DEFAULT);

                if (empty($email) || empty($prenom) || empty($nom) || empty($role_id)) {
                    $_SESSION['error'] = "Il y a un des éléments vides ou incorrects.";
                    header("Location: index.php?action=createUser");
                    exit();
                }

                // Ajouter l'utilisateur dans la base de données
                User::addUser($email, $prenom, $nom, $role_id, $password_hash);

                // Envoi de l'e-mail
                $mail = new PHPMailer(true);

                try {
                    // Configuration du serveur SMTP
                    $mail->isSMTP();
                    $mail->Host = $_ENV['SMTP_HOST'];              // Adresse du serveur SMTP
                    $mail->SMTPAuth = true;                       // Activer l'authentification SMTP
                    $mail->Username = $_ENV['SMTP_USER'];         // Adresse e-mail d'envoi
                    $mail->Password = $_ENV['SMTP_PASSWORD'];     // Mot de passe de l'adresse e-mail
                    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];     // Sécurité (TLS ou SSL)
                    $mail->Port = $_ENV['SMTP_PORT'];             // Port SMTP (465 pour SSL, 587 pour TLS)

                    // Destinataire et contenu de l'e-mail
                    $mail->setFrom($_ENV['SMTP_USER'], 'Support GSB');
                    $mail->addAddress($email);                    // Adresse du destinataire
                    $mail->isHTML(true);                          // Envoyer l'e-mail en HTML
                    $mail->Subject = 'Votre compte a été créé';
                    $mail->Body = "<p>Bonjour <strong>$prenom</strong>,</p>
                <p>Votre compte a été créé avec succès. Voici vos informations de connexion :</p>
                <ul>
                    <li><strong>Nom d'utilisateur :</strong> $email</li>
                    <li><strong>Mot de passe :</strong> $motDePasse</li>
                </ul>
                <p>Veuillez vous connecter et modifier votre mot de passe dès que possible.</p>
                <p><a href='http://gsb.local/index.php?action=login'>Accédez à votre compte</a></p>
                <p>Cordialement,</p>
                <p>L'équipe de support GSB</p>";

                    // Envoyer l'e-mail
                    $mail->send();
                    $_SESSION['success'] = "Utilisateur ajouté avec succès.";
                } catch (Exception $e) {
                    // Gérer l'erreur lors de l'envoi de l'e-mail
                    $_SESSION['error'] = "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
                    header("Location: index.php?action=createUser");
                    exit();
                }
            }

            // Redirection après succès
            header("Location: index.php?action=GestionAcces");
            exit();
        } catch (\Exception $e) {
            // Gérer les erreurs générales
            $_SESSION['error'] = "Une erreur s'est produite";
            header("Location: index.php?action=GestionAcces");
            exit();
        }
    }

    public function updateUser($user_id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                // Récupérer les données utilisateur
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''), ENT_QUOTES, 'UTF-8');
                $nom = htmlspecialchars(trim($_POST['nom'] ?? ''), ENT_QUOTES, 'UTF-8');
                $role_id = filter_input(INPUT_POST, 'role_id', FILTER_SANITIZE_NUMBER_INT);
                $password = htmlspecialchars(trim($_POST['password'] ?? ''), ENT_QUOTES, 'UTF-8');
                $passwordconfirm = htmlspecialchars(trim($_POST['confirmpassword'] ?? ''), ENT_QUOTES, 'UTF-8');

                // Vérifier la correspondance des mots de passe
                if (!empty($password) && $password !== $passwordconfirm) {
                    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                    header("Location: index.php?action=GestionAcces");
                    exit();
                }

                // Vérifier si l'utilisateur connecté a le rôle 'admin' (role_id = 1)
                $current_user_role_id = $_SESSION['role'] ?? null; // Supposons que le rôle est stocké dans la session.

                // Construire dynamiquement les champs à mettre à jour
                $fields = [
                    "email = :email",
                    "prenom = :prenom",
                    "nom = :nom",
                ];

                $params = [
                    ':email' => $email,
                    ':prenom' => $prenom,
                    ':nom' => $nom,
                ];

                // Seul un utilisateur avec role_id = 1 peut modifier le role_id
                if ($current_user_role_id === 1) {
                    $fields[] = "role_id = :role_id";
                    $params[':role_id'] = $role_id;
                }

                if (!empty($password)) {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $fields[] = "password_hash = :password_hash";
                    $params[':password_hash'] = $password_hash;
                }

                // Appeler la méthode du modèle pour mettre à jour
                User::updateUser($fields, $params, $user_id);

                // Redirection après succès
                $_SESSION['success'] = "Utilisateur mis à jour avec succès.";
                header("Location: index.php?action=home");
                exit();
            } catch (\Exception $e) {
                // Gérer les erreurs
                $_SESSION['error'] = "Une erreur s'est produite.";
                header("Location: index.php?action=home");
                exit();
            }
        }
    }


    public function deleteUser($user_id)
    {
        try {
            // Vérifier si l'utilisateur connecté a le rôle 'admin' (role_id = 1)
            $current_user_role_id = $_SESSION['role'] ?? null;
            if ($current_user_role_id !== 1) {
                $_SESSION['error'] = "Vous n'avez pas les droits nécessaires pour supprimé un utilisateur.";
                header("Location: index.php?action=GestionAcces");
                exit();
            }
            if ($_SESSION['user_id'] === $user_id) {
                $_SESSION['error'] = "Vous ne pouvez pas supprimer votre compte";
                header("Location: index.php?action=home");
                exit();
            }
            User::deletingUser($user_id);
            $_SESSION['success'] = "Utilisateur supprimé avec succès.";
        } catch (\Exception $e) {
            $_SESSION['error'] = "Une erreur s'est produite.";
            header("Location: index.php?action=home");
            exit();
        }
    }
}