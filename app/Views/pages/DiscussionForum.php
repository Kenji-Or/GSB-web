<?php
include (BASE_PATH . '/App/Views/layouts/header.php');
if (isset($discussion)):
?>
<div class="container my-5 flex-grow-1">
    <h1>Discussion</h1>
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
    <a href="index.php?action=listForum" class="btn btn-secondary mb-3">Retour aux sujets</a>

    <div class="list-group">
        <?php if (!empty($discussion)): ?>
            <?php foreach ($discussion as $post): ?>
                <div class="list-group-item">
                    <p><?= htmlspecialchars($post['content']) ?></p>
                    <small class="text-muted">
                        Posté par <?= htmlspecialchars($post['prenom']) ?> le <?= date("d/m/Y H:i:s", strtotime($post['date_creation'])) ?>
                    </small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Aucun message dans cette discussion pour le moment.</p>
        <?php endif; ?>
    </div>

    <form action="index.php?action=postforum" method="POST" class="mt-4">
        <div class="form-group">
            <label for="content">Nouveau message</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Entrez votre message..." required></textarea>
        </div>
        <input type="hidden" name="forum_id" value="<?= htmlspecialchars($_GET['forum_id']) ?>">
        <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
    </form>
</div>
<?php
else: ?>
    <p class="text-center">Forum introuvable.</p>
<?php endif;

include(BASE_PATH . '/app/Views/layouts/footer.php');
?>