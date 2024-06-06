<?php
// Inclure les fichiers des contrôleurs nécessaires pour gérer les différentes actions
require_once 'controllers/ControllerAdministrateur.php';
require_once 'controllers/ControllerClient.php';
require_once 'controllers/ControllerBanque.php';
require_once 'controllers/ControllerCompte.php';
require_once 'controllers/ControllerResidence.php';
require_once 'controllers/ControllerUser.php';

// Récupérer l'URI de la requête et la méthode HTTP utilisée
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Découper l'URI pour obtenir les différentes parties (segments)
$uriSegments = explode('/', parse_url($requestUri, PHP_URL_PATH));
$action = $uriSegments[1] ?? 'home';  // Utiliser 'home' comme action par défaut si aucun segment n'est spécifié

// Simuler un routage RESTful en fonction de l'action et de la méthode HTTP
switch ($action) {
    case 'home':
        // Appeler la méthode index du contrôleur home pour afficher la page d'accueil
        ControllerHome::index();
        break;

    case 'banques':
        if ($requestMethod == 'GET') {
            // Appeler la méthode pour lister les banques si la méthode HTTP est GET
            ControllerBanque::listBanques();
        } elseif ($requestMethod == 'POST') {
            // Appeler la méthode pour ajouter une nouvelle banque si la méthode HTTP est POST
            ControllerBanque::addBanque();
        }
        break;

    case 'comptes':
        if ($requestMethod == 'GET') {
            // Appeler la méthode pour lister les comptes si la méthode HTTP est GET
            ControllerCompte::listComptes();
        } elseif ($requestMethod == 'POST') {
            // Appeler la méthode pour ajouter un nouveau compte si la méthode HTTP est POST
            ControllerCompte::addCompte();
        }
        break;

    case 'residences':
        if ($requestMethod == 'GET') {
            // Appeler la méthode pour lister les résidences si la méthode HTTP est GET
            ControllerResidence::listResidences();
        } elseif ($requestMethod == 'POST') {
            // Appeler la méthode pour ajouter une nouvelle résidence si la méthode HTTP est POST
            ControllerResidence::addResidence();
        }
        break;

    case 'clients':
        if ($requestMethod == 'GET') {
            // Appeler la méthode pour lister les clients si la méthode HTTP est GET
            ControllerClient::listClients();
        }
        break;

    case 'login':
        if ($requestMethod == 'POST') {
            // Appeler la méthode pour se connecter si la méthode HTTP est POST
            ControllerUser::login();
        }
        break;

    case 'logout':
        if ($requestMethod == 'POST') {
            // Appeler la méthode pour se déconnecter si la méthode HTTP est POST
            ControllerUser::logout();
        }
        break;

    case 'register':
        if ($requestMethod == 'POST') {
            // Appeler la méthode pour s'inscrire si la méthode HTTP est POST
            ControllerUser::register();
        }
        break;

    default:
        // Si l'action n'est pas reconnue, retourner une erreur 404
        header("HTTP/1.1 404 Not Found");
        echo "404 Page Not Found";
        break;
}
?>
