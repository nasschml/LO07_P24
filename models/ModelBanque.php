<?php
class ModelBanque {
    private $db; // Propriété pour stocker l'instance de la base de données

    // Constructeur de la classe
    public function __construct() {
        // Initialise la connexion à la base de données en appelant la fonction getDB()
        $this->db = getDB();
    }

    // Méthode pour récupérer toutes les banques
    public function getAllBanques() {
        // Exécute une requête SQL pour sélectionner les colonnes 'id' et 'label' de la table 'banque'
        $stmt = $this->db->query("SELECT id, label FROM banque");
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
