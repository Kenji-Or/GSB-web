<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
if (isset($_SESSION['role']) && ($_SESSION['role'] === 1 || $_SESSION['role'] === 2)) {
?>
<div class="container my-5 flex-grow-1">
    <!-- Titre de la page -->
    <div class="text-center p-4 rounded bg-light shadow">
        <h1 class="mb-0">Création d'un article</h1>
    </div>
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <form action="index.php?action=creatingarticle" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre article" required>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="5" placeholder="Écrivez ici..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Sélectionnez une image d'entête:</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                </div>
                <!-- Boutons -->
                <div class="d-flex justify-content-around mt-3">
                    <button type="submit" class="btn btn-success">Importer</button>
                    <a href="index.php?action=actualites" class="btn btn-secondary">Annuler</a>
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
include (BASE_PATH . '/app/Views/layouts/footer.php');