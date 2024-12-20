<?php
include(BASE_PATH . '/app/Views/layouts/header.php');

if (isset($user)) {
    function hasAccess($user, $session) {
        return isset($session['role']) && $session['role'] === 1
            || isset($session['user_id']) && $user['user_id'] === $session['user_id'];
    }

    if (hasAccess($user, $_SESSION)) {
        ?>
        <div class="container my-5 flex-grow-1">
            <!-- Titre de la page -->
            <div class="text-center p-4 rounded bg-light shadow mb-4">
                <h1 class="display-4">Profile</h1>
            </div>
            <div class="card mt-4 shadow-sm">
                <div class="card-body">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>" disabled>
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required value="<?= htmlspecialchars($user['prenom']) ?>" disabled>
                        </div>

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required value="<?= htmlspecialchars($user['nom']) ?>" disabled>
                        </div>

                        <!-- Rôle -->
                        <div class="mb-3">
                            <?php
                            if (isset($roles)) {
                                ?>
                                <label for="role" class="form-label">Rôle</label>
                                <select id="role" name="role_id" class="form-select" required disabled>
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
                            <a href="index.php?action=edit/<?= $user['user_id'] ?>" class="btn btn-primary">Modifier</a>
                    </div>

                </div>
            </div>
            <a class="mt-5" href="index.php?action=mentionLegales">Mentions Légales</a>
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
}
?>

