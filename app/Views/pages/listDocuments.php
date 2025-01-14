<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
?>
<div class="container my-3 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Documents</h1>
    </div>

    <!-- Formulaire de recherche -->
    <form action="index.php?action=searchdocument" method="post" class="d-flex justify-content-center mb-4">
        <div class="input-group w-50">
            <input
                type="text"
                class="form-control"
                placeholder="Entrer le titre du document recherché"
                name="search">
            <button type="submit" name="submit" class="btn btn-primary input-group-append">
                <i class="bi bi-search"></i> Rechercher
            </button>
        </div>
    </form>

    <?php if ($_SESSION['role'] === 1) {
        ?>
        <!-- Bouton Ajouter Utilisateur -->
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php?action=createdocument">
                <button class="btn btn-success">
                    <i class="bi bi-plus"></i> Ajouter un document
                </button>
            </a>
        </div>
    <?php } ?>
            <?php if (isset($documents) && count($documents) > 0): ?>
            <table class="table table-bordered mt-4">
                <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Titre document</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['nom_document'])?></td>
                    <td><?= htmlspecialchars($document['prenom'] . " " . $document['nom'])?></td>
                    <td><?= htmlspecialchars(date("d/m/Y", strtotime($document['date_creation']))) ?></td>
                    <td><a href="index.php?action=document/<?= $document['id_document'] ?>"><button class="btn btn-primary btn-sm me-1">Détail</button></a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>Aucun Document trouvé.</p>
            <?php endif; ?>
</div>
<?php
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
