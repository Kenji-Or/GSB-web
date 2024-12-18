<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

    $db_name = $_ENV['DB_NAME'];
    $db_host =  $_ENV['DB_HOST'];
    $db_user =  $_ENV['DB_USER'];
    $db_pass =  $_ENV['DB_PASS'];
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        // Créer une nouvelle connexion à la base de données
        $pdo = new PDO($dsn, $db_user, $db_pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        throw new \PDOException('Erreur de connexion a la bdd : ' . $e->getMessage());
    }

