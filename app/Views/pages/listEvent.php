<?php
include(BASE_PATH . '/app/Views/layouts/header.php');
?>
<div class="container my-3 flex-grow-1">
    <!-- Titre de la page -->
    <div class="welcome-section text-center p-4 bg-light rounded shadow mb-4">
        <h1 class="display-4">Liste des évènements à venir</h1>
    </div>
    <?php if ($_SESSION['role'] !== 3) {
        ?>
        <!-- Bouton Ajouter Utilisateur -->
        <div class="d-flex justify-content-end mb-3">
            <a href="index.php?action=createevent">
                <button class="btn btn-success">
                    Ajouter un évènement
                </button>
            </a>
        </div>
    <?php } ?>
    <?php if (isset($events) && count($events) > 0):
        // Reformater les événements pour FullCalendar
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event['titre_event'],
                'start' => date('Y-m-d\TH:i:s', strtotime($event['date_start'])),  // Format ISO 8601
                'end' => date('Y-m-d\TH:i:s', strtotime($event['date_end'])),      // Format ISO 8601
                'description' => $event['description'],
                'location' => $event['lieu']
            ];
        }
        ?>
    <div class="row">
        <div class="col-md-8">
            <ul class="list-group">
                <?php foreach ($events as $event): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($event['titre_event']) ?></strong><br />
                    <small><?= htmlspecialchars($event['description']) ?></small><br />
                    <small>Date : <?= htmlspecialchars(date("d/m/Y H:i", strtotime($event['date_start']))) ?></small><br />
                    <small>Lieu : <?= htmlspecialchars($event['lieu']) ?></small>
                    <?php  if ($_SESSION['role'] !== 3) {?>
                        <div class="mt-3 text-end">
                            <a href="index.php?action=deleteEvent/<?= $event['id_event'] ?>"><button class="btn btn-danger">Supprimer</button></a>
                        </div>
                    <?php } ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Calendrier -->
        <div class="col-md-4">
            <h2 class="mb-3">Calendrier</h2>
            <div id="calendar"></div>
        </div>
    </div>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let calendarEl = document.getElementById('calendar');

                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'fr',
                    firstDay: 1,
                    events: <?php echo json_encode($formattedEvents); ?>,
                    eventClick: function(info) {
                        alert('Titre: ' + info.event.title + '\nDébut: ' + info.event.start );
                    }
                });

                calendar.render();
            });
        </script>
    <?php else: ?>
        <p>Aucun évènement à venir.</p>
    <?php endif; ?>
</div>

<?php
include (BASE_PATH . '/app/Views/layouts/footer.php');
