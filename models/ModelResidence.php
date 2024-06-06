<?php
class ModelResidence {
    private $db; // Propriété pour stocker l'instance de la base de données

    // Constructeur de la classe
    public function __construct() {
        // Initialise la connexion à la base de données en appelant la fonction getDB()
        $this->db = getDB();
    }

    // Méthode pour récupérer les résidences d'une personne spécifique
    public function getResidencesByPersonne($personne_id) {
        // Prépare une requête SQL pour sélectionner les résidences appartenant à une personne spécifique
        $stmt = $this->db->prepare("
            SELECT residence.id, residence.label, residence.ville, residence.prix
            FROM residence
            WHERE residence.personne_id = :personne_id
        ");
        // Exécute la requête avec le paramètre 'personne_id'
        $stmt->execute(['personne_id' => $personne_id]);
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer toutes les résidences qui ont des comptes associés
    public function getAllResidencesWithAccounts() {
        // Exécute une requête SQL pour sélectionner toutes les résidences avec leurs comptes associés
        $stmt = $this->db->query("
            SELECT residence.id, residence.label, residence.ville, residence.prix, personne.login AS vendeur, compte.id AS compte_vendeur_id
            FROM residence
            JOIN personne ON residence.personne_id = personne.id
            JOIN compte ON compte.personne_id = personne.id
            WHERE residence.personne_id IS NOT NULL
            GROUP BY residence.id
        ");
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer toutes les résidences
    public function getAllResidences() {
        // Exécute une requête SQL pour sélectionner toutes les résidences avec leurs vendeurs et comptes associés
        $stmt = $this->db->query("
            SELECT residence.id, residence.label, residence.ville, residence.prix, personne.login AS vendeur, compte.id AS compte_vendeur_id
            FROM residence
            JOIN personne ON residence.personne_id = personne.id
            JOIN compte ON compte.personne_id = personne.id
            WHERE residence.personne_id IS NOT NULL
            GROUP BY residence.id
        ");
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les résidences qui ne sont pas possédées par une personne spécifique
    public function getResidencesNotOwnedBy($personne_id) {
        // Prépare une requête SQL pour sélectionner les résidences qui ne sont pas possédées par une personne spécifique
        $stmt = $this->db->prepare("
            SELECT residence.id, residence.label, residence.ville, residence.prix, personne.nom AS vendeur, compte.id AS compte_vendeur_id
            FROM residence
            JOIN personne ON residence.personne_id = personne.id
            JOIN compte ON compte.personne_id = personne.id
            WHERE residence.personne_id != :personne_id AND compte.id IS NOT NULL
        ");
        // Exécute la requête avec le paramètre 'personne_id'
        $stmt->execute(['personne_id' => $personne_id]);
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
