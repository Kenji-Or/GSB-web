<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        // Vérifier que la méthode de la requête est POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // Chercher l'utilisateur par email
            $user = User::findByEmail($email);

            // Vérifier que l'utilisateur existe et que le mot de passe est correct
            if ($user && password_verify($password, $user['password_hash'])) {
                $token = bin2hex(random_bytes(32));
                date_default_timezone_set('Europe/Paris'); // Exemple pour Paris
                $expireAt = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valable 1 heure
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['role'] = $user['role_id'];
                $_SESSION['user_id'] = $user['user_id'];

                session_regenerate_id(true);

                User::saveToken($user['user_id'],$token, $expireAt);
                $_SESSION['token'] = $token;

                // Rediriger vers la page d'accueil après connexion réussie
                header("Location: index.php?action=home");
                exit;
            } else {
                // Afficher un message d'erreur si les informations ne correspondent pas
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: index.php?action=login");
                http_response_code(401);
                exit;
            }
        }
    }

    public function verifyToken($token)
    {
        return User::verifyToken($token);
    }

    public function logout()
    {
        session_start();
        User::deleteToken($_SESSION['token']);
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
