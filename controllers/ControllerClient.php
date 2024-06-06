<?php
class ControllerClient {
    // Méthode pour afficher la liste des comptes d'un utilisateur
    public function mesComptes() {
        $personne_id = $_SESSION['personne_id']; // Récupère l'ID de l'utilisateur connecté
        $modelCompte = new ModelCompte(); // Crée une instance du modèle de compte
        $comptes = $modelCompte->getComptesByPersonne($personne_id); // Récupère les comptes de l'utilisateur
        require_once 'views/client/listeComptes.php'; // Charge la vue pour afficher les comptes
    }

    // Méthode pour ajouter un nouveau compte
    public function ajouterCompte() {
        $modelBanque = new ModelBanque(); // Crée une instance du modèle de banque
        $banques = $modelBanque->getAllBanques(); // Récupère toutes les banques

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupère les données du formulaire
            $label = $_POST['label'];
            $montant = $_POST['montant'];
            $banque_id = $_POST['banque_id'];
            $personne_id = $_SESSION['personne_id'];

            $modelCompte = new ModelCompte(); // Crée une instance du modèle de compte
            $result = $modelCompte->ajouterCompte($label, $montant, $banque_id, $personne_id); // Ajoute le compte

            if ($result) {
                // Redirige vers la liste des comptes en cas de succès
                header("Location: " . BASE_URL . "index.php?controller=client&action=mesComptes");
                exit();
            } else {
                // Affiche un message d'erreur en cas d'échec
                echo "Erreur lors de l'ajout du compte.<br>";
            }
        } else {
            // Charge la vue pour afficher le formulaire d'ajout de compte
            require_once 'views/client/ajouterCompte.php';
        }
    }

    // Méthode pour transférer de l'argent entre comptes
    public function transfertCompte() {
        $personne_id = $_SESSION['personne_id']; // Récupère l'ID de l'utilisateur connecté
        $modelCompte = new ModelCompte(); // Crée une instance du modèle de compte
        $comptes = $modelCompte->getComptesByPersonne($personne_id); // Récupère les comptes de l'utilisateur

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupère les données du formulaire
            $compte_source_id = $_POST['compte_source'];
            $compte_dest_id = $_POST['compte_dest'];
            $montant = $_POST['montant'];

            $result = $modelCompte->transfertCompte($compte_source_id, $compte_dest_id, $montant); // Effectue le transfert

            if ($result) {
                // Redirige vers la liste des comptes en cas de succès
                header("Location: " . BASE_URL . "index.php?controller=client&action=mesComptes");
                exit();
            } else {
                // Affiche un message d'erreur en cas d'échec
                echo "Erreur lors du transfert de compte.<br>";
            }
        } else {
            // Charge la vue pour afficher le formulaire de transfert de compte
            require_once 'views/client/transfertCompte.php';
        }
    }

    // Méthode pour afficher la liste des résidences d'un utilisateur
    public function mesResidences() {
        $personne_id = $_SESSION['personne_id']; // Récupère l'ID de l'utilisateur connecté
        $modelResidence = new ModelResidence(); // Crée une instance du modèle de résidence
        $residences = $modelResidence->getResidencesByPersonne($personne_id); // Récupère les résidences de l'utilisateur
        require_once 'views/client/listeResidences.php'; // Charge la vue pour afficher les résidences
    }

    // Méthode pour acheter une résidence
    public function acheterResidence() {
        $personne_id = $_SESSION['personne_id']; // Récupère l'ID de l'utilisateur connecté
        $modelCompte = new ModelCompte(); // Crée une instance du modèle de compte
        $modelResidence = new ModelResidence(); // Crée une instance du modèle de résidence
        $modelPersonne = new ModelPersonne(); // Crée une instance du modèle de personne
        $personne = $modelPersonne->getPersonneById($personne_id); // Récupère les informations de l'utilisateur

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupère les données du formulaire
            $residence_id = $_POST['residence_id'];
            $compte_acheteur_id = $_POST['compte_acheteur'];
            $compte_vendeur_id = $_POST['compte_vendeur'];
            $prix = $_POST['prix'];
            $vendeur_id = $_POST['vendeur_id'];

            // Vérifie le solde du compte acheteur
            $soldeCompteAcheteur = $modelCompte->getSoldeCompte($compte_acheteur_id);
            if ($soldeCompteAcheteur < $prix) {
                $erreur = "Solde insuffisant pour effectuer l'achat.";
                $comptes = $modelCompte->getComptesByPersonne($personne_id);
                $residences = $modelResidence->getResidencesNotOwnedBy($personne_id);
                require_once 'views/client/acheterResidence.php';
                return;
            }

            // Effectue le transfert
            $modelCompte->transfertCompte($compte_acheteur_id, $compte_vendeur_id, $prix);
            // Met à jour la propriété de la résidence
            $stmt = $modelResidence->db->prepare("UPDATE residence SET personne_id = :personne_id WHERE id = :residence_id");
            $stmt->execute(['personne_id' => $personne_id, 'residence_id' => $residence_id]);

            // Redirige vers la liste des résidences en cas de succès
            header("Location: index.php?controller=client&action=mesResidences");
            exit();
        } else {
            // Charge les comptes et résidences pour le formulaire d'achat
            $comptes = $modelCompte->getComptesByPersonne($personne_id);
            $residences = $modelResidence->getResidencesNotOwnedBy($personne_id);
            require_once 'views/client/acheterResidence.php';
        }
    }

    // Méthode pour afficher le bilan du patrimoine d'un utilisateur
    public function bilanPatrimoine() {
        $personne_id = $_SESSION['personne_id']; // Récupère l'ID de l'utilisateur connecté
        $modelCompte = new ModelCompte(); // Crée une instance du modèle de compte
        $modelResidence = new ModelResidence(); // Crée une instance du modèle de résidence

        // Récupère les comptes et résidences de l'utilisateur
        $comptes = $modelCompte->getComptesByPersonne($personne_id);
        $residences = $modelResidence->getResidencesByPersonne($personne_id);

        // Calcule les totaux des comptes et des résidences
        $totalComptes = array_sum(array_column($comptes, 'montant'));
        $totalResidences = array_sum(array_column($residences, 'prix'));
        $totalPatrimoine = $totalComptes + $totalResidences;

        // Charge la vue pour afficher le bilan du patrimoine
        require_once 'views/client/bilanPatrimoine.php';
    }

    // Méthode pour prévoir la date possible d'achat en fonction des comptes et des économies mensuelles
    public function previsionSolde() {
        $personne_id = $_SESSION['personne_id'];
        $modelCompte = new ModelCompte();
        $modelResidence = new ModelResidence();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectedResidences = isset($_POST['selected_residences']) ? $_POST['selected_residences'] : [];
            $monthlySavings = isset($_POST['monthly_savings']) ? (float) $_POST['monthly_savings'] : 0;
            $monthlySalary = isset($_POST['monthly_salary']) ? (float) $_POST['monthly_salary'] : 0;

            $residences = $modelResidence->getResidencesNotOwnedBy($personne_id);
            $selectedResidencesDetails = [];
            foreach ($residences as $residence) {
                if (in_array($residence['id'], $selectedResidences)) {
                    $selectedResidencesDetails[] = $residence;
                }
            }

            try {
                $dateAchatPossible = $modelCompte->calculerDateAchatPossible($personne_id, $selectedResidencesDetails, $monthlySavings, $monthlySalary);
                $currentDate = new DateTime();
                $interval = $currentDate->diff($dateAchatPossible);
                $monthsNeeded = ($interval->y * 12) + $interval->m;

                $suggestLoan = false;
                if ($monthsNeeded > 12) { // Par exemple, si plus de 12 mois sont nécessaires
                    $suggestLoan = true;
                }

                require_once 'views/client/previsionSoldeResultat.php';
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                $comptes = $modelCompte->getComptesByPersonne($personne_id);
                $residences = $modelResidence->getResidencesNotOwnedBy($personne_id);
                require_once 'views/client/previsionSolde.php';
            }
        } else {
            $comptes = $modelCompte->getComptesByPersonne($personne_id);
            $residences = $modelResidence->getResidencesNotOwnedBy($personne_id);
            require_once 'views/client/previsionSolde.php';
        }
    }
}
?>
