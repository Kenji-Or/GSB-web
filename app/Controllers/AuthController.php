<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        date_default_timezone_set('Europe/Paris');
        // Vérifier que la méthode de la requête est POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            // Définir le nombre d'essais de connexion maximum autorisé
            $max_attempts = 3;
            // Définir la durée de blocage
            $block_duration = 300; // 5 minutes en secondes

            // Chercher l'utilisateur par email
            $user = User::findByEmail($email);
            if ($user) {
                // Vérifier si l'utilisateur est bloqué
                $current_time = time();
                $blocked_until = strtotime($user['blocked_until']); // Date et heure du blocage
                $failed_attempts = $user['login_attempts']; // Tentatives échouées

                // Si l'utilisateur est bloqué et la période de blocage n'est pas terminée
                if ($failed_attempts >= $max_attempts && $current_time < $blocked_until) {
                    $remaining_time = $blocked_until - $current_time;
                    $_SESSION['error'] = "Vous avez atteint le nombre maximal de tentatives de connexion. Veuillez réessayer dans " . ceil($remaining_time / 60) . " minute(s).";
                    header("Location: index.php?action=login");
                    exit;
                }

                // Vérifier que l'utilisateur existe et que le mot de passe est correct
                if (password_verify($password, $user['password_hash']) && $user['status'] === 'active') {
                    // Réinitialiser les tentatives échouées et le blocage
                    User::resetLoginAttempts($email);
                    $token = bin2hex(random_bytes(32));
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
                    // Incrémenter les tentatives échouées
                    User::incrementLoginAttempts($email);
                    // Afficher un message d'erreur si les informations ne correspondent pas
                    $_SESSION['error'] = "Email ou mot de passe incorrect.";
                    // Si l'utilisateur atteint le nombre maximal de tentatives
                    if ($failed_attempts + 1 >= $max_attempts) {
                        // Définir la date et l'heure de blocage
                        $block_until = date('Y-m-d H:i:s', strtotime("+5 minutes"));
                        User::setBlockUntil($email, $block_until);  // Enregistrer le blocage dans la DB
                        $_SESSION['error'] = "Trop de tentatives échouées. Votre compte est bloqué pendant 5 minutes.";
                    }
                    header("Location: index.php?action=login");
                    exit;
                }
            } else {
                // Si l'utilisateur n'existe pas
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: index.php?action=login");
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
        User::deleteToken($_SESSION['token']);
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
