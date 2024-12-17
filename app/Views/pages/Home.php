<?php
// Inclusion du header
include(BASE_PATH . '/app/Views/layouts/header.php');

// Échapper les données de la session pour éviter les attaques XSS
$nom = htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8');
$prenom = htmlspecialchars($_SESSION['prenom'], ENT_QUOTES, 'UTF-8');
$role = $_SESSION['role'];
?>

<div class="container my-4 flex-grow-1">
    <!-- Message de bienvenue -->
    <div class="welcome-section text-center p-4 bg-light rounded">
        <h1>Bienvenue <?php echo $prenom; ?> sur l’intranet GSB</h1>
    </div>

    <!-- Contenu principal divisé en deux sections -->
    <div class="content d-flex flex-wrap mt-4 gap-3">
        <!-- Section Actualité -->
        <?php if (isset($articles) && count($articles) > 0) { ?>
            <div class="actualites-container p-4 bg-white rounded flex-fill text-center shadow-sm">
                <?php foreach ($articles as $index => $article) { ?>
                    <div class="actualite-item" id="article-<?php echo $index; ?>" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>; background-image: url('index.php?action=view_file&file=<?php echo htmlspecialchars($article['image']); ?>'); background-size: cover;background-position: center;height: 300px;" >
                        <a class="text-decoration-none text-dark" href="index.php?action=viewArticle/<?= $article['id_article'] ?>">
                        <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
                        </a>
                    </div>

                <?php } ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const articles = document.querySelectorAll('.actualite-item');
                    let currentIndex = 0;

                    setInterval(() => {
                        // Hide the current article
                        articles[currentIndex].style.display = 'none';

                        // Show the next article
                        currentIndex = (currentIndex + 1) % articles.length;
                        articles[currentIndex].style.display = 'block';
                    }, 15000); // 15 seconds
                });
            </script>
        <?php } else { ?>
            <p>Aucune actualité à afficher.</p>
        <?php } ?>

        <!-- Section Événements à venir -->
        <div class="evenements  bg-white rounded text-center shadow-sm" ">
            <?php if (isset($events) && count($events) > 0) { ?>
                <div class="row g-4">
                    <?php foreach ($events as $event): ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-primary text-center"><?= htmlspecialchars($event['titre_event']); ?></h5>
                                    <p class="card-text text-center">
                                        <?= htmlspecialchars($event['description']); ?>
                                    </p>
                                    <p class="card-text text-center text-muted mt-auto">
                                        <small>Date : <?= htmlspecialchars(date("d/m/Y H:i", strtotime($event['date_start']))) ?></small>
                                    </p>
                                    <a href="index.php?action=listEvent" class="btn btn-primary w-100 mt-3">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else { ?>
                <p>Aucun évènement à venir.</p>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include(BASE_PATH . '/app/Views/layouts/footer.php');
?>
