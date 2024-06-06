<?php
class ModelPersonne {
    // Constantes pour les statuts des personnes
    public const ADMINISTRATEUR = 0;
    public const CLIENT = 1;

    private $db; // Propriété pour stocker l'instance de la base de données

    // Constructeur de la classe
    public function __construct() {
        // Initialise la connexion à la base de données en appelant la fonction getDB()
        $this->db = getDB();
    }

    // Méthode pour récupérer une personne par son ID
    public function getPersonneById($id) {
        // Prépare une requête SQL pour sélectionner toutes les colonnes de la table 'personne' où l'id correspond
        $stmt = $this->db->prepare("SELECT * FROM personne WHERE id = :id");
        // Exécute la requête avec le paramètre 'id'
        $stmt->execute(['id' => $id]);
        // Retourne le résultat sous forme de tableau associatif
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer tous les clients
    public function getAllClients() {
        // Exécute une requête SQL pour sélectionner toutes les personnes avec le statut de client
        $stmt = $this->db->query("SELECT * FROM personne WHERE statut = " . self::CLIENT);
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer tous les administrateurs
    public function getAllAdmins() {
        // Exécute une requête SQL pour sélectionner toutes les personnes avec le statut d'administrateur
        $stmt = $this->db->query("SELECT * FROM personne WHERE statut = " . self::ADMINISTRATEUR);
        // Retourne les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour authentifier un utilisateur
    public function authenticate($login, $password) {
        // Prépare une requête SQL pour sélectionner toutes les colonnes de la table 'personne' où le login correspond
        $stmt = $this->db->prepare("SELECT * FROM personne WHERE login = :login");
        // Exécute la requête avec le paramètre 'login'
        $stmt->execute(['login' => $login]);
        // Récupère le résultat sous forme de tableau associatif
        $personne = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si la personne existe et si le mot de passe fourni correspond au mot de passe haché
        if ($personne && password_verify($password, $personne['password'])) {
            // Retourne les informations de la personne si l'authentification réussit
            return $personne;
        }
        // Retourne false si l'authentification échoue
        return false;
    }

    // Méthode pour enregistrer un nouvel utilisateur
    public function register($nom, $prenom, $login, $password) {
        try {
            // Prépare une requête SQL pour insérer une nouvelle personne
            $stmt = $this->db->prepare("INSERT INTO personne (nom, prenom, login, password, statut) VALUES (:nom, :prenom, :login, :password, :statut)");
            // Exécute la requête avec les paramètres fournis, le mot de passe étant haché
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'statut' => self::CLIENT // Assigné en tant que client par défaut
            ]);
            return true; // Retourne true si l'insertion a réussi
        } catch (PDOException $e) {
            // Affiche un message d'erreur en cas d'échec
            echo "Erreur: " . $e->getMessage() . "<br>";
            return false; // Retourne false si une exception est levée
        }
    }
}
?>
