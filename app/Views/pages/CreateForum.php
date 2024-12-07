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
        <button type="submit" class="btn btn-primary mt-3">Créer le Sujet</button>
        <a href="index.php?action=forum" class="btn btn-secondary mt-3">Annuler</a>
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