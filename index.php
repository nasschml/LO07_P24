<?php

// Afficher les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start the session
session_start();

// Include the configuration
require_once 'config/config.php';

// Include the session helper functions
require_once 'helpers/session_helper.php';

// Define the base URL of your application
define('BASE_URL', 'https://dev-isi.utt.fr/~chemlaln/lo07_tds/projet/');

// Autoload the required classes (controllers and models)
spl_autoload_register(function ($className) {
    if (file_exists('controllers/' . $className . '.php')) {
        require_once 'controllers/' . $className . '.php';
    } elseif (file_exists('models/' . $className . '.php')) {
        require_once 'models/' . $className . '.php';
    }
});

// Include the router
require_once 'router1.php';

// Route the request
router();
?>
