<?php
include(BASE_PATH . 'app/Views/layouts/header.php');
?>
<div class="container my-3 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Actualités</h1>
    </div>
    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <!-- Bouton Ajouter Utilisateur -->
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php?action=createArticle">
                <button class="btn btn-success">
                    Ajouter un article
                </button>
            </a>
        </div>
    <?php } ?>
    <?php if (isset($articles) && count($articles) > 0): ?>
    <!-- Affichage des articles -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col">
                    <div class="card h-100">
                        <img
                                src="index.php?action=view_file&file=<?= htmlspecialchars($article['image']) ?>"
                                class="card-img-top"
                                alt="image article"
                                style="height: 200px; object-fit: cover;"
                        />
                        <div class="card-body">
                            <a class="text-decoration-none card-title" href="index.php?action=viewArticle/<?= $article['id_article'] ?>"><h5><?= htmlspecialchars($article['titre']) ?></h5></a>
                            <p class="card-text"><?= htmlspecialchars(substr($article['contenu'], 0, 200)) ?>...</p>
                        </div>
                        <div class="card-footer text-muted">
                            <p>Ecrit par: <?= htmlspecialchars($article['prenom'] . " " . $article['nom']) ?></p>
                            <p>Publié le <?= htmlspecialchars($article['date_publication']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun Actualités actuellement.</p>
    <?php endif; ?>

</div>

<?php
include(BASE_PATH . 'app/Views/layouts/footer.php');
