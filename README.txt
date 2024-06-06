README - Projet de Gestion de Patrimoine

Introduction
Le projet de gestion de patrimoine est une application web permettant aux utilisateurs de gérer leurs comptes bancaires, leurs résidences, et de suivre l'évolution de leur patrimoine. Le projet est structuré en deux parties principales : la partie client et la partie administrateur. Ce README se concentre sur la partie client, décrivant la structure du projet, les classes et leurs responsabilités, ainsi que les fonctionnalités implémentées.

Structure du Projet
Le projet suit le modèle MVC (Modèle-Vue-Contrôleur) pour une séparation claire des responsabilités et une meilleure organisation du code. Voici la structure des dossiers et fichiers :

/projet_patrimoine
├── /config
│   └── config.php
├── /controllers
│   ├── ControllerAdministrateur.php
│   ├── ControllerClient.php
│   ├── ControllerHome.php
│   ├── ControllerLogin.php
│   └── ControllerRegister.php
├── /models
│   ├── ModelBanque.php
│   ├── ModelCompte.php
│   ├── ModelPersonne.php
│   └── ModelResidence.php
├── /views
│   ├── /admin
│   │   ├── ajouterBanque.php
│   │   ├── listeBanques.php
│   │   ├── listeClients.php
│   │   ├── listeComptes.php
│   │   ├── listeComptesBanque.php
│   │   ├── listeResidences.php
│   │   └── listeAdmins.php
│   ├── /client
│   │   ├── ajouterCompte.php
│   │   ├── acheterResidence.php
│   │   ├── bilanPatrimoine.php
│   │   ├── listeComptes.php
│   │   ├── listeResidences.php
│   │   └── transfertCompte.php
│   ├── /common
│   │   ├── header.php
│   │   ├── footer.php
│   │   └── menu.php
│   ├── login.php
│   ├── register.php
│   └── home.php
├── /assets
│   ├── /css
│   │   └── styles.css
│   ├── /js
│   │   └── scripts.js
│   └── /images
├── /sql
│   └── patrimoine_base.sql
├── /helpers
│   └── session_helper.php
├── router1.php
├── index.php
└── router2.php


Configuration de la Base de Données
Le fichier config/config.php contient les informations de connexion à la base de données et les configurations nécessaires pour l'environnement de développement et de production.

Modèles
Les modèles contiennent la logique d'accès aux données et d'interaction avec la base de données.

ModelBanque : Gestion des opérations liées aux banques.
ModelCompte : Gestion des opérations liées aux comptes bancaires.
ModelPersonne : Gestion des opérations liées aux utilisateurs (clients et administrateurs).
ModelResidence : Gestion des opérations liées aux résidences.

Contrôleurs
Les contrôleurs gèrent la logique de l'application. Ils reçoivent les requêtes de l'utilisateur, interagissent avec les modèles pour récupérer ou manipuler les données, et retournent la vue appropriée.

ControllerClient : Gère les opérations des clients, telles que la gestion des comptes, des résidences, et la prévision de solde.
ControllerHome : Gère l'affichage de la page d'accueil.
ControllerLogin : Gère l'authentification des utilisateurs (connexion et déconnexion).
ControllerRegister : Gère l'inscription des nouveaux utilisateurs.
ControllerAdministrateur : À implémenter pour gérer les opérations des administrateurs.


Vues
Les vues sont responsables de l'affichage des données. Elles récupèrent les données des contrôleurs et les présentent sous forme de HTML.

Client

ajouterCompte.php : Formulaire pour ajouter un compte bancaire.
listeComptes.php : Affiche la liste des comptes bancaires du client.
listeResidences.php : Affiche la liste des résidences du client.
acheterResidence.php : Formulaire pour acheter une résidence.
transfertCompte.php : Formulaire pour transférer des fonds entre comptes.
bilanPatrimoine.php : Affiche le bilan du patrimoine du client.
previsionSolde.php : Formulaire pour prévoir la date d'achat de résidences.
previsionSoldeResultat.php : Affiche les résultats de la prévision de solde.
Commun

header.php : En-tête commune de l'application.
footer.php : Pied de page commun de l'application.
menu.php : Menu de navigation commun de l'application.

Pages d'authentification

login.php : Formulaire de connexion.
register.php : Formulaire d'inscription.

Page d'accueil

home.php : Page d'accueil de l'application.

Router
Le routeur (router1.php) gère les requêtes HTTP, détermine le contrôleur et l'action appropriée à appeler en fonction des paramètres de l'URL, et transmet la requête au contrôleur concerné.

Helpers
Les helpers contiennent des fonctions utilitaires.

session_helper.php : Gère les opérations liées aux sessions, telles que l'initialisation, la destruction, et la vérification des utilisateurs connectés.

Conclusion de la partie
La partie client du projet de gestion de patrimoine a été développée en suivant une architecture MVC, garantissant une bonne séparation des responsabilités et facilitant la maintenance et l'évolution du code. Les fonctionnalités implémentées permettent aux clients de gérer efficacement leurs comptes bancaires et résidences, et de suivre l'évolution de leur patrimoine. La prochaine étape consistera à développer la partie administrateur, permettant une gestion plus approfondie et des fonctionnalités spécifiques aux administrateurs de l'application.
