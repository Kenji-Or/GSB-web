<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
?>

<div class="container my-4 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow">
        <h1>Gestion des accès</h1>
    </div>
    <!-- Bouton Ajouter Utilisateur -->
    <div class="d-flex justify-content-end mb-3 mt-3">
        <a href="index.php?action=createUser"><button class="btn btn-success">Ajouter un utilisateur</button></a>
    </div>
    <!-- Tableau des utilisateurs -->
    <?php if (isset($users) && count($users) > 0): ?>
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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['prenom']) ." ". htmlspecialchars($user['nom'])?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <button class="btn btn-primary btn-sm me-1">Modifier</button>
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</div>

<?php
} else {
    ?>
    <div class="container my-5 flex-grow-1">
        <div class="text-center bg-danger text-white p-5 rounded shadow">
            <h1 class="display-4">Accès refusé</h1>
            <p>Vous n'avez pas l'autorisation d'accéder à cette page.</p>
        </div>
    </div>
<?php
}
include(BASE_PATH . '/app/Views/layouts/footer.html');
?>
