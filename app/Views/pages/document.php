<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
if (isset($document) && $document !== false):
    if ($document['document_pdf']) {
    $pdfPath = htmlspecialchars($document['document_pdf']);
?>
<div class="container my-3 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4"><?= htmlspecialchars($document['nom_document'])?></h1>
    </div>

    <iframe src="<?= $pdfPath ?>" width="100%" height="600px"> </iframe>

    <!-- Section auteur et date -->
    <div class="document-meta text-center mt-4">
        <p class="text-muted mb-1">
            <strong>Auteur : </strong>
            <span><?= htmlspecialchars($document['prenom'] . " " . $document['nom']) ?></span>
        </p>
        <p class="text-muted">
            <strong>Date de publication : </strong>
            <span><?= htmlspecialchars(date("d/m/Y", strtotime($document['date_creation']))) ?></span>
        </p>
    </div>

    <?php if ($_SESSION['role'] === 1) {
        ?>
    <div class="mt-3 text-center">
        <a href="index.php?action=deleteDocument/<?= $document['id_document'] ?>"><button class="btn btn-danger">Supprimer</button></a>
    </div>
    <?php } ?>
</div>

<?php } else { ?>
        <p class="text-center">Document introuvable.</p>
    <?php
    }
 else: ?>
     <div class="text-center">
         <div class="error-message">
             <h2 class="mb-4">Oups! La page que vous recherchez est introuvable.</h2>
             <p>Il semble que la page que vous cherchez n'existe pas. Essayez de revenir à la page d'accueil.</p>
             <a href="index.php?action=home" class="btn btn-primary">Retour à l'accueil</a>
         </div>
     </div>
<?php endif;

include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
