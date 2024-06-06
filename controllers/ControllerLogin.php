<?php
class ControllerLogin {
    // Méthode pour gérer l'affichage et le traitement de la page de connexion
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupère les données du formulaire de connexion
            $login = $_POST['login'];
            $password = $_POST['password'];
            $modelPersonne = new ModelPersonne(); // Crée une instance du modèle de personne
            $personne = $modelPersonne->authenticate($login, $password); // Authentifie l'utilisateur

            if ($personne) {
                // Si l'authentification réussit, stocke les informations de l'utilisateur dans la session
                $_SESSION['personne_id'] = $personne['id'];
                $_SESSION['statut'] = $personne['statut'];
                // Redirige vers la page d'accueil
                header("Location: " . BASE_URL);
                exit();
            } else {
                // Si l'authentification échoue, affiche un message d'erreur
                $error = "Login ou mot de passe incorrect.";
                require_once 'views/login.php'; // Charge la vue de connexion avec l'erreur
            }
        } else {
            // Si la méthode de requête n'est pas POST, affiche le formulaire de connexion
            require_once 'views/login.php';
        }
    }

    // Méthode pour gérer la déconnexion
    public function logout() {
        // Détruit la session pour déconnecter l'utilisateur
        session_destroy();
        // Redirige vers la page d'accueil
        header("Location: " . BASE_URL);
        exit();
    }
}
?>
