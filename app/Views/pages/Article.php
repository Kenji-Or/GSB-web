<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
if (isset($article)) {
?>
    <div class="container my-3 flex-grow-1">
        <!-- Titre de la page -->
        <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
            <h1 class="display-4"><?= htmlspecialchars($article['titre'])?></h1>
        </div>
        <article>
            <!-- Contenu de l'article -->
            <div class="fs-5 lh-lg">
                <?= nl2br(htmlspecialchars($article['contenu'])) ?>
            </div>
            <!-- Informations de l'article -->
            <div class="text-center text-muted mt-4">
                <p class="mb-1">
                    Par <strong><?= htmlspecialchars($article['prenom'] . " " . $article['nom']) ?></strong>
                </p>
                <p class="mb-0">Publié le <?= htmlspecialchars($article['date_publication']) ?></p>
            </div>
        </article>

    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <!-- Bouton Ajouter Utilisateur -->
        <div class="d-flex justify-content-center mt-4">
            <a href="index.php?action=deletearticle/<?= $article['id_article'] ?>" class="btn btn-danger">
                    Supprimer un article
            </a>
        </div>
        <?php } ?>
    </div>

    <?php
} else { ?>
    <p class="text-center">Article introuvable.</p>
<?php }
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>