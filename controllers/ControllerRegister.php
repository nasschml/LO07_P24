<?php
class ControllerRegister {
    // Méthode pour gérer l'affichage et le traitement de la page d'inscription
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupère les données du formulaire d'inscription
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            $modelPersonne = new ModelPersonne(); // Crée une instance du modèle de personne
            $result = $modelPersonne->register($nom, $prenom, $login, $password); // Enregistre la nouvelle personne

            if ($result) {
                // Si l'inscription réussit, redirige vers la page de connexion
                header("Location: " . BASE_URL . "index.php?controller=login&action=index");
                exit();
            } else {
                // Si l'inscription échoue, affiche un message d'erreur
                echo "Erreur lors de la création du compte.<br>";
            }
        } else {
            // Si la méthode de requête n'est pas POST, affiche le formulaire d'inscription
            require_once 'views/register.php';
        }
    }
}
?>
