<?php
class ModelCompte {
    private $db; // Propriété pour stocker l'instance de la base de données

    // Constructeur de la classe
    public function __construct() {
        // Initialise la connexion à la base de données en appelant la fonction getDB()
        $this->db = getDB();
    }

    // Méthode pour récupérer tous les comptes
    public function getAllComptes() {
        // Exécute une requête SQL pour sélectionner toutes les colonnes de la table 'compte'
        $stmt = $this->db->query("SELECT * FROM compte");
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les comptes d'une personne spécifique
    public function getComptesByPersonne($personne_id) {
        // Prépare une requête SQL avec jointure pour récupérer les comptes et leurs banques associées
        $stmt = $this->db->prepare("
            SELECT compte.id, compte.label, compte.montant, compte.banque_id, banque.label AS banque_label
            FROM compte
            JOIN banque ON compte.banque_id = banque.id
            WHERE compte.personne_id = :personne_id
        ");
        // Exécute la requête avec le paramètre 'personne_id'
        $stmt->execute(['personne_id' => $personne_id]);
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour ajouter un nouveau compte
    public function ajouterCompte($label, $montant, $banque_id, $personne_id) {
        try {
            // Prépare une requête SQL pour insérer un nouveau compte
            $stmt = $this->db->prepare("INSERT INTO compte (label, montant, banque_id, personne_id) VALUES (:label, :montant, :banque_id, :personne_id)");
            // Exécute la requête avec les paramètres fournis
            $stmt->execute([
                'label' => $label,
                'montant' => $montant,
                'banque_id' => $banque_id,
                'personne_id' => $personne_id
            ]);
            return true; // Retourne true si l'insertion a réussi
        } catch (PDOException $e) {
            // Affiche un message d'erreur en cas d'échec
            echo "Erreur: " . $e->getMessage() . "<br>";
            return false; // Retourne false si une exception est levée
        }
    }

    // Méthode pour effectuer un transfert entre deux comptes
    public function transfertCompte($compte_source_id, $compte_dest_id, $montant) {
        try {
            // Démarre une transaction
            $this->db->beginTransaction();

            // Prépare et exécute la requête pour débiter le compte source
            $stmt = $this->db->prepare("UPDATE compte SET montant = montant - :montant WHERE id = :compte_source_id");
            $stmt->execute([
                'montant' => $montant,
                'compte_source_id' => $compte_source_id
            ]);

            // Prépare et exécute la requête pour créditer le compte destination
            $stmt = $this->db->prepare("UPDATE compte SET montant = montant + :montant WHERE id = :compte_dest_id");
            $stmt->execute([
                'montant' => $montant,
                'compte_dest_id' => $compte_dest_id
            ]);

            // Valide la transaction
            $this->db->commit();
            return true; // Retourne true si le transfert a réussi
        } catch (PDOException $e) {
            // Annule la transaction en cas d'erreur
            $this->db->rollBack();
            // Affiche un message d'erreur
            echo "Erreur: " . $e->getMessage() . "<br>";
            return false; // Retourne false si une exception est levée
        }
    }

    // Méthode pour récupérer le solde d'un compte
    public function getSoldeCompte($compte_id) {
        // Prépare une requête SQL pour sélectionner le montant d'un compte spécifique
        $stmt = $this->db->prepare("SELECT montant FROM compte WHERE id = :compte_id");
        // Exécute la requête avec le paramètre 'compte_id'
        $stmt->execute(['compte_id' => $compte_id]);
        // Retourne le montant du compte
        return $stmt->fetch(PDO::FETCH_ASSOC)['montant'];
    }

    // Méthode pour calculer la date possible d'achat en fonction des comptes et des économies mensuelles
    public function calculerDateAchatPossible($personne_id, $selectedResidences, $monthlySavings, $monthlySalary) {
        $soldeTotal = 0;

        // Récupérer les comptes du client
        $comptes = $this->getComptesByPersonne($personne_id);
        foreach ($comptes as $compte) {
            $soldeTotal += $compte['montant'];
        }

        // Calculer le prix total des résidences sélectionnées
        $totalPrixResidences = 0;
        foreach ($selectedResidences as $residence) {
            $totalPrixResidences += $residence['prix'];
        }

        // Calculer le nombre de mois nécessaires pour atteindre le prix total
        $monthlyIncome = $monthlySavings + $monthlySalary;
        if ($monthlyIncome <= 0) {
            throw new Exception("Impossible de prévoir l'achat avec des économies et un salaire mensuels nuls ou négatifs.");
        }

        $monthsNeeded = ceil(($totalPrixResidences - $soldeTotal) / $monthlyIncome);
        if ($monthsNeeded <= 0) {
            throw new Exception("Vous pouvez déjà acheter les résidences sélectionnées.");
        }

        // Calculer la date d'achat possible
        $currentDate = new DateTime();
        $dateAchatPossible = $currentDate->add(new DateInterval('P' . $monthsNeeded . 'M'));

        // Retourne la date d'achat possible
        return $dateAchatPossible;
    }

    // Méthode pour récupérer les informations d'une personne par son ID
    public function getPersonneById($id) {
        // Prépare une requête SQL pour sélectionner les informations d'une personne spécifique
        $stmt = $this->db->prepare("SELECT nom, prenom, statut FROM personne WHERE id = :id");
        // Exécute la requête avec le paramètre 'id'
        $stmt->execute(['id' => $id]);
        // Retourne les informations de la personne sous forme de tableau associatif
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
