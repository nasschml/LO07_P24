<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['personne_id']);
}

// Vérifie si l'utilisateur est un administrateur
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['statut']) && $_SESSION['statut'] == ModelPersonne::ADMINISTRATEUR;
}

// Vérifie si l'utilisateur est un client
function isClient() {
    return isLoggedIn() && isset($_SESSION['statut']) && $_SESSION['statut'] == ModelPersonne::CLIENT;
}

// Redirige vers la page de connexion si l'utilisateur n'est pas connecté
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: " . BASE_URL . "index.php?controller=login&action=index");
        exit();
    }
}

// Redirige vers la page d'accueil si l'utilisateur n'est pas administrateur
function requireAdmin() {
    if (!isAdmin()) {
        header("Location: " . BASE_URL);
        exit();
    }
}

// Redirige vers la page d'accueil si l'utilisateur n'est pas client
function requireClient() {
    if (!isClient()) {
        header("Location: " . BASE_URL);
        exit();
    }
}
?>
