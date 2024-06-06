<?php
// Fonction router pour gérer les requêtes et diriger vers les contrôleurs et actions appropriés
function router() {
    // Récupère le contrôleur depuis l'URL ou utilise 'home' par défaut
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    // Récupère l'action depuis l'URL ou utilise 'index' par défaut
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    // Switch case pour charger le contrôleur approprié en fonction du paramètre de l'URL
    switch ($controller) {
        case 'client':
            // Inclut le fichier du contrôleur client et instancie le contrôleur
            require_once 'controllers/ControllerClient.php';
            $controller = new ControllerClient();
            break;
        case 'home':
            // Inclut le fichier du contrôleur home et instancie le contrôleur
            require_once 'controllers/ControllerHome.php';
            $controller = new ControllerHome();
            break;
        case 'login':
            // Inclut le fichier du contrôleur login et instancie le contrôleur
            require_once 'controllers/ControllerLogin.php';
            $controller = new ControllerLogin();
            break;
        case 'register':
            // Inclut le fichier du contrôleur register et instancie le contrôleur
            require_once 'controllers/ControllerRegister.php';
            $controller = new ControllerRegister();
            break;
        default:
            // Lève une exception si le contrôleur n'est pas trouvé
            throw new Exception("Controller not found: $controller");
    }

    // Vérifie si l'action existe dans le contrôleur
    if (!method_exists($controller, $action)) {
        // Lève une exception si l'action n'est pas trouvée
        throw new Exception("Action not found: $action");
    }

    // Appelle l'action du contrôleur
    $controller->$action();
}
?>
