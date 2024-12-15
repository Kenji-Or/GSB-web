<?php
namespace App\Controllers;
use App\Models\User;
use App\Models\PasswordReset;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();
class PasswordController {
    public function sendResetLink()
    {
        $email = htmlspecialchars(trim($_POST['email'] ?? ''), ENT_QUOTES, 'UTF-8');

        if (empty($email)) {
            $_SESSION['error'] = 'Le champ email n\'est pas valide';
            header('location: index.php?action=passwordoublier');
            exit();
        }

        $user = User::findByEmail($email);

        if (!$user) {
            $_SESSION['error'] = 'L\'email n\'existe pas';
            header('location: index.php?action=passwordoublier');
            exit();
        }

        $token = bin2hex(random_bytes(32));
        PasswordReset::storeToken($user['user_id'], $token);

        $resetLink = "http://gsb.local/index.php?action=linkResetPassword&token=$token";
        $prenom = $user['prenom'];
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
            $mail->Subject = "Demande de reinitialisation de mot de passe";
            $mail->Body = "<p>Bonjour <strong>$prenom</strong>,</p>
                <p>Nous avons reçu une demande de réinitialisation du mot de passe associé à votre compte. Si vous êtes à l'origine de cette demande, veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe : </p>
                <p><a href=$resetLink>Accédez à votre compte</a></p>
                <p>Pour des raisons de sécurité, ce lien sera valable pendant 1 heure. Si vous ne réinitialisez pas votre mot de passe dans ce délai, vous devrez effectuer une nouvelle demande.</p>
                <p><strong>Important : Si vous n'êtes pas à l'origine de cette demande, il est possible qu'elle ait été initiée par erreur. Dans ce cas, aucune action de votre part n'est requise, et votre mot de passe actuel reste inchangé.</strong></p>
                <p>Pour toute question ou assistance supplémentaire, n'hésitez pas à contacter notre service client à kenjiogier@gmail.com.</p>
                <p>Cordialement,</p>
                <p>L'équipe de support GSB</p>";

            // Envoyer l'e-mail
            $mail->send();
            $_SESSION['success'] = "Demande de réinitialisation de mot de passe effectuée avec succès.";
            header('location: index.php?action=login');
            exit();
        } catch (Exception $e) {
            // Gérer l'erreur lors de l'envoi de l'e-mail
            $_SESSION['error'] = "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
            header("Location: index.php?action=passwordoublier");
            exit();
        }
    }

    public function resetPassword() {
        // Récupérer le token depuis l'URL
        $token = htmlspecialchars(trim($_GET['token'] ?? ''), ENT_QUOTES, 'UTF-8');

        if (empty($token)) {
            $_SESSION['error'] = 'Une erreur s\'est produite, veuillez réessayer.';
            header("Location: index.php?action=login");
            exit();
        }

        // Vérifier si le jeton est valide
        $resetEntry = PasswordReset::findByToken($token);

        if (!$resetEntry || strtotime($resetEntry['expires_at']) < time()) {
            $_SESSION['error'] = 'Une erreur s\'est produite, veuillez réessayer.';
            header("Location: index.php?action=linkResetPassword&token=$token");
            exit();
        }

        // Afficher le formulaire si aucune soumission
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error'] = 'Une erreur s\'est produite, veuillez réessayer.';
            header("Location: index.php?action=login"); // Charger la vue avec un formulaire
            return;
        }

        // Récupérer le nouveau mot de passe depuis la requête POST
        $newPassword = htmlspecialchars(trim($_POST['password'] ?? ''), ENT_QUOTES, 'UTF-8');

        if (strlen($newPassword) < 8) {
            $_SESSION['error'] = 'Le mot de passe doit faire au minimum 8 caractères.';
            header("Location: index.php?action=linkResetPassword&token=$token");
            exit();
        }

        // Mettre à jour le mot de passe de l'utilisateur
        User::updatePassword($resetEntry['user_id'], $newPassword);

        // Supprimer le jeton utilisé
        PasswordReset::deleteToken($resetEntry['user_id']);

        $_SESSION['success'] = 'Mot de passe modifier avec succès !';
        header("Location: index.php?action=login");
        exit();
    }
}