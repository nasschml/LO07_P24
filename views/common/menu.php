<?php
// Vérifie si l'utilisateur est connecté
$loggedIn = isset($_SESSION['personne_id']);

// Obtient le statut de l'utilisateur s'il est connecté
$statut = $loggedIn ? $_SESSION['statut'] : null;

// Crée une instance du modèle Personne pour récupérer les informations de l'utilisateur
$modelPersonne = new ModelPersonne();
$personne = $loggedIn ? $modelPersonne->getPersonneById($_SESSION['personne_id']) : null;

// Concatène le prénom et le nom de l'utilisateur ou utilise "Visiteur" si non connecté
$nomPrenom = $personne ? $personne['prenom'] . ' ' . $personne['nom'] : 'Visiteur';

// Définit le statut de l'utilisateur : "Client de prestige" ou "Visiteur"
$statut = $personne && $personne['statut'] == 1 ? 'Client de prestige' : 'Visiteur';
?>

<!-- Navigation de la barre de menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Marque de la barre de navigation -->
    <a class="navbar-brand" href="#">CHEMLAL VU </a>
    
    <!-- Bouton pour la navigation mobile -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Contenu de la barre de navigation -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if ($loggedIn): ?>
                <!-- Affiche le nom, prénom et statut de l'utilisateur connecté -->
                <li class="nav-item">
                    <span class="navbar-text"><?= $nomPrenom ?> (<?= $statut ?>)</span>
                </li>
                
                <!-- Menu déroulant pour les comptes -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownComptes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mes Comptes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownComptes">
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=mesComptes">Liste de mes comptes</a>
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=ajouterCompte">Ajouter un nouveau compte</a>
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=transfertCompte">Transfert intercompte</a>
                    </div>
                </li>
                
                <!-- Menu déroulant pour les résidences -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownResidences" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mes Résidences
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownResidences">
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=mesResidences">Liste résidence</a>
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=acheterResidence">Achat d'une résidence</a>
                    </div>
                </li>
                
                <!-- Menu déroulant pour le patrimoine -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPatrimoine" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon Patrimoine
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownPatrimoine">
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=bilanPatrimoine">Bilan de mon patrimoine</a>
                    </div>
                </li>
                
                <!-- Menu déroulant pour les innovations -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownInnovations" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Innovations
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownInnovations">
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=client&action=previsionSolde">Prévision de solde</a>
                        <a class="dropdown-item" href="<?= BASE_URL ?>index.php?controller=home&action=ameliorationMVC">Amélioration MVC du cours</a>
                    </div>
                </li>
                
                <!-- Option de déconnexion -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>index.php?controller=login&action=logout">Se Déconnecter</a>
                </li>
            <?php else: ?>
                <!-- Options de connexion et d'inscription pour les visiteurs -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>index.php?controller=login&action=index">Se Connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>index.php?controller=register&action=index">S'inscrire</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
