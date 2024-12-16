<?php
namespace App\Models;

use PDO;

class Evenement
{
    private static function getDBConnection()
    {
        // Inclure le fichier de configuration de la base de données
        return require __DIR__ . '/../config/db.php';
    }
    public static function allEvents()
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('SELECT * FROM evenements WHERE date_end >= NOW() ORDER BY date_start ASC');
        $stmt->execute();
        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function nextEvent()
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('SELECT * FROM evenements WHERE date_end >= NOW() ORDER BY date_start ASC LIMIT 3');
        $stmt->execute();
        $db = null;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addEvent($titre, $description, $dateStart, $dateEnd, $lieu)
    {
        $db = self::getDBConnection();
        $stmt= $db->prepare('INSERT INTO evenements (titre_event, date_start, date_end, description, lieu) VALUES (:titre_event, :date_start, :date_end, :description, :lieu)');
        $stmt->BindValue(':titre_event', $titre);
        $stmt->BindValue(':date_start', $dateStart);
        $stmt->BindValue(':date_end', $dateEnd);
        $stmt->BindValue(':description', $description);
        $stmt->BindValue(':lieu', $lieu);
        $stmt->execute();
        $db = null;
        return true;
    }

    public static function deleteEvent($id)
    {
        $db = self::getDBConnection();
        $stmt = $db->prepare('DELETE FROM evenements WHERE id_event = :id_event');
        $stmt->execute(['id_event' => $id]);
        $db = null;
        return true;
    }
}