<?php
namespace App\Controllers;
use App\Models\Evenement;

class EvenementController {
    public function getAllEvenements() {
        return Evenement::allEvents();
    }

    public function nextEvent()
    {
        return Evenement::nextEvent();
    }

    public function createEvenement() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['role'] !== 3) {
            $titre = trim($_POST['titre'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $dateStart = trim($_POST['dateStart'] ?? '');
            $dateEnd = trim($_POST['dateEnd'] ?? '');
            $lieu = trim($_POST['lieu'] ?? '');
            $user_id = trim($_SESSION['user_id'] ?? '');

            $current_time = date('Y-m-d H:i:s'); // Date et heure actuelles au format MySQL

            if (empty($titre) || empty($description) || empty($dateStart) || empty($dateEnd) || empty($lieu) || empty($user_id)) {
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header('location: index.php?action=createEvent');
                exit();
            }

            // Vérification des dates
            if ($dateStart < $current_time && $dateEnd < $current_time) {
                $_SESSION['error'] = 'La date ne peut pas être dans le passé.';
                header('location: index.php?action=createEvent');
                exit();
            }

            $event = Evenement::addEvent($titre, $description, $dateStart, $dateEnd, $lieu, $user_id);
            $event === true ? $_SESSION['success'] = 'Evènement ajouté avec succès.' : $_SESSION['error'] = 'Erreur lors de l\'ajout de l\'evenement.';
            header('location: index.php?action=listEvent');
            exit();
        } else {
            $_SESSION['error'] = "Méthode non autorisée.";
            header("Location: index.php?action=createEvent");
            exit;
        }
    }

    public function deleteEvenement($id) {
        if ($_SESSION['role'] !== 3) {
            $deleteEvent = Evenement::deleteEvent($id);
            if ($deleteEvent === true) {
                $_SESSION['success'] = 'Evènement supprimé.';
            } else {
                $_SESSION['error'] = 'Erreur lors de la suppression.';
            }
        } else {
            $_SESSION['error'] = "Vous n'avez pas les droits nécessaires pour supprimé un évènement.";
            header('location: index.php?action=listEvent');
            exit();
        }
    }
}