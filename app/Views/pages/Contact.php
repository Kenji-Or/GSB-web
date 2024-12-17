<?php
include (BASE_PATH . "/app/Views/layouts/header.php");
?>
<div class="container my-5 flex-grow-1">
    <!-- Titre de la page -->
    <div class="text-center p-4 rounded bg-light shadow">
        <h1 class="mb-0">Contact</h1>
    </div>
    <form action="index.php?action=sendDataContact" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ben Tali" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com" required>
        </div>
        <div class="mb-3">
            <label for="sujet" class="form-label">Sujet</label>
            <input type="text" name="sujet" id="sujet" class="form-control" placeholder="Je n'arrive pas a accéder a cette partie du site..." required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="explication détailler..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php
include (BASE_PATH . "/app/Views/layouts/footer.php");
?>
