<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        //session_start();

        // Vérifier que la méthode de la requête est POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // Chercher l'utilisateur par email
            $user = User::findByEmail($email);

            // Vérifier que l'utilisateur existe et que le mot de passe est correct
            if ($user && password_verify($password, $user['password_hash'])) {
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                session_regenerate_id();

                $_SESSION['last_activity'] = time();

                // Rediriger vers la page d'accueil après connexion réussie
                header("Location: index.php?action=home");
                exit;
            } else {
                // Afficher un message d'erreur si les informations ne correspondent pas
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: index.php?action=login");
                exit;
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
