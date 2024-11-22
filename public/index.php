<?php
// Définir la constante du chemin de base du projet
define('BASE_PATH', dirname(__DIR__) . '/');

// Charger l'autoload de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Démarrer la session
session_start();

// Inclure les routes
require_once BASE_PATH . 'routes/web.php';
