<?php
include(BASE_PATH . '/app/Views/layouts/header.php');

if (isset($user)) {
    function hasAccess($user) {
        return isset($_SESSION['role']) && $_SESSION['role'] === 1
            || isset($_SESSION['user_id']) && $user['user_id'] === $_SESSION['user_id'];
    }

    if (hasAccess($user)) {
        ?>
        <div class="container my-5 flex-grow-1">
            <!-- Titre de la page -->
            <div class="text-center p-4 rounded bg-light shadow">
                <h1 class="mb-0">Modifier utilisateur</h1>
            </div>
            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <form action="index.php?action=updateUser/<?= $user['user_id'] ?>" method="POST">
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required value="<?= htmlspecialchars($user['prenom']) ?>">
                        </div>

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required value="<?= htmlspecialchars($user['nom']) ?>">
                        </div>

                        <!-- Rôle -->
                        <div class="mb-3">
                            <?php
                            if (isset($roles)) {
                                ?>
                            <label for="role" class="form-label">Rôle</label>
                                <select id="role" name="role_id" class="form-select" required>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role['id_role'] ?>" <?= $user['role_id'] == $role['id_role'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($role['role']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php } ?>
                        </div>
                        <!-- Boutons -->
                        <div class="d-flex justify-content-around mt-5">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1) { ?>
                            <a href="index.php?action=GestionAcces" class="btn btn-secondary">Annuler</a>
                            <?php } else { ?>
                            <a href="index.php?action=home" class="btn btn-secondary">Annuler</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
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
}
?>

