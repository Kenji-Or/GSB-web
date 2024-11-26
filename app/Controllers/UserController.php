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
        $users = User::getAllUsers();
        require_once __DIR__ . '/../Views/pages/GestionAcces.php';
    }

    public function editUser($id)
    {
        return User::findById($id);
    }

    public function addingUser() {

        // Générer un mot de passe aléatoire
        function genererMotDePasse($longueur = 12) {
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
            $motDePasse = '';
            $maxIndex = strlen($caracteres) - 1;
            for ($i = 0; $i < $longueur; $i++) {
                $motDePasse .= $caracteres[random_int(0, $maxIndex)];
            }
            return $motDePasse;
        }

        // Vérifier que la méthode de la requête est POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $motDePasse = genererMotDePasse();
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $prenom = filter_input(INPUT_POST, 'prenom');
            $nom = filter_input(INPUT_POST, 'nom');
            $role_id = filter_input(INPUT_POST, 'role_id');
            $password_hash = password_hash($motDePasse, PASSWORD_DEFAULT);


            User::addUser($email, $prenom, $nom, $role_id, $password_hash);

            // Envoi de l'e-mail
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_HOST'];               // Adresse du serveur SMTP (par ex. smtp.gmail.com pour Gmail)
                $mail->SMTPAuth = true;                       // Activer l'authentification SMTP
                $mail->Username = $_ENV['SMTP_USER'];  // Adresse e-mail d'envoi
                $mail->Password = $_ENV['SMTP_PASSWORD'];       // Mot de passe de l'adresse e-mail
                $mail->SMTPSecure = $_ENV['SMTP_SECURE']; // Sécurité (TLS ou SSL)
                $mail->Port = $_ENV['SMTP_PORT'];                            // Port SMTP (465 pour SSL, 587 pour TLS)

                // Destinataire et contenu de l'e-mail
                $mail->setFrom($_ENV['SMTP_USER'], 'Support GSB');
                $mail->addAddress($email);         // Adresse du destinataire
                $mail->isHTML(true);                          // Envoyer l'e-mail en HTML
                $mail->Subject = 'Votre compte a ete cree';
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
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
            }
        }
        header("Location: index.php?action=GestionAcces");
        exit();
    }

    public function updateUser($user_id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $prenom = filter_input(INPUT_POST, 'prenom');
            $nom = filter_input(INPUT_POST, 'nom');
            $role_id = filter_input(INPUT_POST, 'role_id');
            // Vérifier si un nouveau mot de passe est fourni
            $password = filter_input(INPUT_POST, 'password');
            $passwordconfirm = filter_input(INPUT_POST, 'confirmpassword');
            if ($password !== $passwordconfirm) {
                die("Les mots de passe ne correspondent pas.");
            }
            $password_hash = null;

            if (!empty($password)) {
                // Hacher le mot de passe uniquement s'il est fourni
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
            }

            User::updateUser($user_id, $email, $prenom, $nom, $role_id, $password_hash);
        }
    }

    public function deleteUser($user_id)
    {
        User::deletingUser($user_id);
    }
}