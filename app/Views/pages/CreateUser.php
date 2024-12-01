<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');

if (isset($_SESSION['role']) && $_SESSION['role'] === 1) {
    ?>

    <div class="container my-5 flex-grow-1">
        <!-- Titre de la page -->
        <div class="text-center p-4 rounded bg-light shadow">
            <h1 class="mb-0">Création d'utilisateur</h1>
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
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <form action="index.php?action=creatinguser" method="POST">
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required>
                    </div>

                    <!-- Prénom -->
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Jean" required>
                    </div>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Bon" required>
                    </div>

                    <!-- Rôle -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select id="role" name="role_id" class="form-select" required>
                            <option disabled selected>- SELECTIONNER UN ROLE -</option>
                            <?php
                            if (isset ($roles)) {
                                foreach ($roles as $role) {
                                    ?><option value="<?= $role['id_role'] ?>"><?= htmlspecialchars($role['role']) ?></option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-around mt-5">
                        <button type="submit" class="btn btn-success">Créer</button>
                        <a href="index.php?action=GestionAcces" class="btn btn-secondary">Annuler</a>
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
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
