<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['nom'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php?action=login");
    exit;
}

// Échapper les données de la session pour éviter les attaques XSS
$nom = htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8');
$prenom = htmlspecialchars($_SESSION['prenom'], ENT_QUOTES, 'UTF-8');
$role = htmlspecialchars($_SESSION['role'], ENT_QUOTES, 'UTF-8');
?>

<div class="container my-4 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded">
        <h1>Gestion des accès</h1>
    </div>
    <!-- Bouton Ajouter Utilisateur -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success">Ajouter un utilisateur</button>
    </div>
    <!-- Tableau des utilisateurs -->
    <table class="table table-striped table-bordered">
        <thead class="table-light">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Jean Dupont</td>
            <td>jean.dupont@example.com</td>
            <td>User</td>
            <td>
                <button class="btn btn-primary btn-sm me-1">Modifier</button>
                <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
        </tr>
        <tr>
            <td>Marie Curie</td>
            <td>marie.curie@example.com</td>
            <td>Manager</td>
            <td>
                <button class="btn btn-primary btn-sm me-1">Modifier</button>
                <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
        </tr>
        <tr>
            <td>Admin Root</td>
            <td>admin@example.com</td>
            <td>Admin</td>
            <td>
                <button class="btn btn-primary btn-sm me-1">Modifier</button>
                <button class="btn btn-danger btn-sm">Supprimer</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<?php
include(BASE_PATH . '/app/Views/layouts/footer.html');
?>
