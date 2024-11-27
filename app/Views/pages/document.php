<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
if (isset($document) && $document['document_pdf']):
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
            <span><?= htmlspecialchars($document['auteur']) ?></span>
        </p>
        <p class="text-muted">
            <strong>Date de publication : </strong>
            <span><?= htmlspecialchars(date("d/m/Y", strtotime($document['date_creation']))) ?></span>
        </p>
    </div>

</div>

<?php
else: ?>
    <p class="text-center">Document introuvable.</p>
<?php endif;

include(BASE_PATH . '/app/Views/layouts/footer.html');
?>
