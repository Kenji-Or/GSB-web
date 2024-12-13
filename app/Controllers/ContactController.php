<?php
namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

use App\Models\Contact;

class ContactController {
    public function envoieContact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(trim($_POST['name']),ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars(trim($_POST['email']),ENT_QUOTES, 'UTF-8');
            $sujet = htmlspecialchars(trim($_POST['sujet']),ENT_QUOTES, 'UTF-8');
            $message = htmlspecialchars(trim($_POST['message']),ENT_QUOTES, 'UTF-8');

            if (empty($name) || empty($email) || empty($sujet) || empty($message)) {
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header('location: index.php?action=contact');
                exit();
            }

            $adminEmails = Contact::getAdminEmails();
            $fullMessage = "Prénom: $name\nEmail: $email\nSujet: $sujet\nMessage: $message";
            // Envoi de l'e-mail
            $mail = new PHPMailer(true);
            foreach ($adminEmails as $adminEmail) {
                try {
                    // Configuration du serveur SMTP
                    $mail->isSMTP();
                    $mail->Host = $_ENV['SMTP_HOST'];              // Adresse du serveur SMTP
                    $mail->SMTPAuth = true;                       // Activer l'authentification SMTP
                    $mail->Username = $_ENV['SMTP_USER'];         // Adresse e-mail d'envoi
                    $mail->Password = $_ENV['SMTP_PASSWORD'];     // Mot de passe de l'adresse e-mail
                    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];     // Sécurité (TLS ou SSL)
                    $mail->Port = $_ENV['SMTP_PORT'];

                    $mail->setFrom($_ENV['SMTP_USER'], 'Support GSB');
                    $mail->addAddress($adminEmail);

                    $mail->isHTML(true);
                    $mail->Subject = $sujet;
                    $mail->Body = $fullMessage;
                    $mail->send();
                } catch (Exception $e) {
                    $_SESSION['error'] = "Échec de l'envoi";
                }
            }

            $_SESSION['success'] = "Message envoyé avec succès.";
            header('location: index.php?action=home');
            exit();
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header('location: index.php?action=contact');
            exit();
        }
    }
}