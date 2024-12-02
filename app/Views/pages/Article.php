<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
if (isset($article)) {
?>
    <div class="container my-3 flex-grow-1">
        <!-- Titre de la page -->
        <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
            <h1 class="display-4"><?= htmlspecialchars($article['titre'])?></h1>
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
        <article>
            <!-- Contenu de l'article -->
            <div class="fs-5 lh-lg">
                <?= nl2br(htmlspecialchars($article['contenu'])) ?>
            </div>
            <!-- Informations de l'article -->
            <div class="text-center text-muted mt-4">
                <p class="mb-1">
                    Par <strong><?= htmlspecialchars($article['auteur']) ?></strong>
                </p>
                <p class="mb-0">Publié le <?= htmlspecialchars($article['date_publication']) ?></p>
            </div>
        </article>
    </div>

    <?php
} else { ?>
    <p class="text-center">Article introuvable.</p>
<?php }
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>