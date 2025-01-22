<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
?>

<div class="container my-5 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow">
        <h1 class="display-4">Gestion des accès</h1>
    </div>
    <!-- Bouton Ajouter Utilisateur -->
    <div class="d-flex justify-content-end mb-3 mt-3">
        <a href="index.php?action=createUser"><button class="btn btn-success"><i class="bi bi-plus"></i> Ajouter un utilisateur</button></a>
    </div>
    <!-- Tableau des utilisateurs -->
    <?php if (isset($users) && count($users) > 0): ?>
    <table class="table table-bordered ">
        <thead class="table-primary text-center">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Rôle</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td class="text-center"><?= htmlspecialchars($user['prenom']) ." ". htmlspecialchars($user['nom'])?></td>
                <td class="text-center"><?= htmlspecialchars($user['email']) ?></td>
                <td class="text-center"><?= htmlspecialchars($user['role']) ?></td>
                <?php if ($user['user_id'] !== $_SESSION['user_id']) { ?>
                <td class="text-center">
                    <a href="index.php?action=edit/<?= $user['user_id'] ?>"><button class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil"></i> Modifier</button></a>
                    <a href="index.php?action=delete/<?= $user['user_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button></a>
                </td>
                <?php } else {?>
                <td></td>
                <?php } ?>
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
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
