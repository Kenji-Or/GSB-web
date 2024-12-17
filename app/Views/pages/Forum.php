<?php
include (BASE_PATH . '/App/Views/layouts/header.php');
?>
<div class="container my-5 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Forum</h1>
    </div>

    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <!-- Bouton Ajouter Utilisateur -->
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php?action=createForum">
                <button class="btn btn-success">
                    Créer un nouveau sujet
                </button>
            </a>
        </div>
    <?php }
if (isset($forum) && count($forum) > 0):
    ?>

    <ul class="list-group mt-3">
        <?php foreach ($forum as $thread): ?>
            <li class="list-group-item">
                <a href="index.php?action=forum&forum_id=<?= $thread['id_forum'] ?>">
                    <?= htmlspecialchars($thread['titre_forum']) ?>
                </a>
                <br>
                <small>Créé par <?= htmlspecialchars($thread['prenom']) ?> le <?= htmlspecialchars(date("d/m/Y", strtotime($thread['date_creation']))) ?></small>
                <?php if ($_SESSION['role'] === 1 || ($thread['user_id'] === $_SESSION['user_id'] && $_SESSION['role'] === 2)) { ?>
                    <div class="text-end">
                    <a class="btn btn-danger" href="index.php?action=deleteDiscussion/<?= htmlspecialchars($thread['id_forum']) ?>">Supprimer sujet</a>
                    </div>
                <?php } ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php
else: ?>
    <p>Aucune discussion actuellement.</p>
<?php endif; ?>
</div>

<?php
include (BASE_PATH . '/App/Views/layouts/footer.php');
