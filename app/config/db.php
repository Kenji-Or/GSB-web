<?php
    $db_name = "gsb";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
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
        throw new \PDOException('Erreur de connexion a la bd : ' . $e->getMessage());
    }

