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
                name="search"
                required>
            <button type="submit" name="submit" class="btn btn-primary input-group-append">
                <i class="bi bi-search"></i> Rechercher
            </button>
        </div>
    </form>

    <!-- Bouton Ajouter Utilisateur -->
    <div class="d-flex justify-content-end mb-3">
        <a href="index.php?action=createdocument">
            <button class="btn btn-success">
                Ajouter un document
            </button>
        </a>
    </div>
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <?php if (isset($documents) && count($documents) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                <tr>
                    <th>Titre document</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['nom_document'])?></td>
                    <td><?= htmlspecialchars($document['auteur'])?></td>
                    <td><?= htmlspecialchars($document['date_creation'])?></td>
                    <td><a href="index.php?action=document/<?= $document['id_document'] ?>"><button class="btn btn-primary btn-sm me-1">Détail</button></a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>Aucun Document trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include(BASE_PATH . '/app/Views/layouts/footer.html');
?>
