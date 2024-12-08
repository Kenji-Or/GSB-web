<?php
include (BASE_PATH . '/App/Views/layouts/header.php');
if (isset($discussion)):
?>
<div class="container-fluid flex-grow-1" style="display: flex;
            flex-direction: column;
            height:80vh;">
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
    <a href="index.php?action=listForum" class="btn btn-secondary mb-3 btn-sm float-start">Retour aux sujets</a>

    <div id="messages" style="flex: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #f9f9f9;">
        <?php if (!empty($discussion)): ?>
            <?php foreach ($discussion as $post): ?>
                <div style="max-width: 60%;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 10px;
            <?= $post['user_id'] == $_SESSION['user_id'] ?
                    'align-self: flex-end; background-color: #007bff; color: white;' :
                    'align-self: flex-start; background-color: #e9ecef;'; ?>">
                    <p><?= htmlspecialchars($post['content']) ?></p>
                    <small class="text-muted">
                        <?= $post['user_id'] == $_SESSION['user_id'] ? 'Vous' : htmlspecialchars($post['prenom']) ?>, <?= date("d/m/Y H:i:s", strtotime($post['date_creation'])) ?>
                    </small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Aucun message pour l'instant. Soyez le premier à écrire !</p>
        <?php endif; ?>
    </div>

    <form action="index.php?action=postforum" method="POST" style="padding: 10px;
            background-color: white;
            border-top: 1px solid #ddd;">
        <div class="input-group">
            <textarea class="form-control" name="content" rows="1" placeholder="Écrivez un message..." required style="resize: none;"></textarea>
            <input type="hidden" name="forum_id" value="<?= htmlspecialchars($_GET['forum_id']) ?>">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
<?php
else: ?>
    <p class="text-center">Forum introuvable.</p>
<?php endif;
?>
</div>
    <script>
        // Scroller automatiquement vers le bas des messages au chargement
        const messagesDiv = document.getElementById('messages');
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    </script>
<?php

include(BASE_PATH . '/app/Views/layouts/footer.php');
?>