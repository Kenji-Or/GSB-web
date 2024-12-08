<?php
include (BASE_PATH . '/App/Views/layouts/header.php');
if (isset($_SESSION['role']) && $_SESSION['role'] !== 3) {
?>
<div class="container my-5 flex-grow-1">
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Créer une nouvelle discussion</h1>
    </div>
    <!-- Affichage du message d'erreur -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-2">
            <?php
            // Utilisation de htmlspecialchars pour éviter les attaques XSS
            echo htmlspecialchars($_SESSION['error']);
            // Supprimer le message d'erreur après l'affichage
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=creatingforum" method="POST">
        <div class="form-group">
            <label for="titre">Titre du Sujet</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez le titre du sujet" required>
        </div>
        <!-- Sélection des rôles autorisés -->
        <div class="mb-3">
            <label class="form-label">Sélectionner les rôles ayant accès</label>
            <?php if (isset($roles)){
            foreach ($roles as $role): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="<?= $role['id_role'] ?>" id="role_<?= $role['id_role'] ?>">
                    <label class="form-check-label" for="role_<?= $role['id_role'] ?>">
                        <?= htmlspecialchars($role['role']) ?>
                    </label>
                </div>
            <?php endforeach;
            }
            ?>
        </div>

        <!-- Sélection des utilisateurs spécifiques -->
        <div class="mb-3">
            <label class="form-label">Sélectionner des utilisateurs spécifiques (optionnel)</label>
            <?php if (isset($users)){
        foreach ($users as $user): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="users[]" value="<?= $user['user_id'] ?>" id="user_<?= $user['user_id'] ?>">
                    <label class="form-check-label" for="user_<?= $user['user_id'] ?>">
                        <?= htmlspecialchars($user['prenom']) ?> (<?= htmlspecialchars($user['role']) ?>)
                    </label>
                </div>
            <?php endforeach;
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer le Sujet</button>
        <a href="index.php?action=listForum" class="btn btn-secondary mt-3">Annuler</a>
    </form>
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
include (BASE_PATH . '/app/Views/layouts/footer.php');