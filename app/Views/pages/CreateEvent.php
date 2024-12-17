<?php
include (BASE_PATH . '/app/Views/layouts/header.php');
if (isset($_SESSION['role']) && $_SESSION['role'] !== 3) {
?>
<div class="container my-5 flex-grow-1">
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Créer un nouvel évènement</h1>
    </div>
    <form action="index.php?action=creatingevent" method="POST">
        <div class="mb-3">
            <label for="titre" class="form-label">Nom de l'évènement</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="Entrez un titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description de l'évènement</label>
            <textarea name="description" id="description" class="form-control" placeholder="Entrez une desciption de l'évènement" required rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="dateStart" class="form-label">Date début de l'évènement</label>
            <input type="datetime-local" class="form-control" id="dateStart" name="dateStart" required min="<?php echo date("Y-m-d\TH:i"); ?>">
        </div>
        <div class="mb-3">
            <label for="dateEnd" class="form-label">Date fin de l'évènement</label>
            <input type="datetime-local" class="form-control" id="dateEnd" name="dateEnd" required min="<?php echo date("Y-m-d\TH:i"); ?>">
        </div>
        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu de l'évènement</label>
            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Entrez une ville" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer l'évènement</button>
        <a href="index.php?action=listEvent" class="btn btn-secondary">Annuler</a>
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
