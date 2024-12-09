<?php
ob_start();
// Active l'affichage des erreurs
ini_set('display_errors', 1);

// Définit le niveau de rapport d'erreur (toutes les erreurs)
error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'vendor/autoload.php';

use App\R301\Controller\RecetteController;
use App\R301\Controller\CommentController;
use App\R301\Controller\ContactController;
use App\R301\Controller\UserController;
use App\R301\Controller\FavoriController;



$recettesController = new RecetteController();
$contactController = new ContactController();
$userController = new UserController();
$favoriController = new FavoriController();
$commentController = new CommentController();

if (!isset($_GET["x"])) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'header.php');
}

// Récupérer les paramètres de l'URL
$controller = $_GET['url'] ?? 'home';
$action = $_GET['a'] ?? 'index';

// Routeur basé sur les contrôleurs
switch ($controller) {
    case 'home':
        switch ($action) {
            case 'index':
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'homeController.php');
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    case 'contact':
        switch ($action) {
            case 'contact':
                $contactController->contact();
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    case 'recettes':
        switch ($action) {
            case 'indexJSON':
                $recettesController->indexJSON();
                break;
            case 'index':
                $filtre = $_GET['filtre'] ?? null;
                $recettesController->index($filtre);
                break;
            case 'ajouter':
                $recettesController->ajouter();
                break;
            case 'enregistrer':
                $recettesController->enregistrer();
                break;
            case 'detail':
                $id = $_GET['id'] ?? null;

                $recettesController->detail($id);
                break;
            case 'afficherFormulaireModification':
                $id = $_GET['id'] ?? null;
                $recettesController->afficherFormulaireModification($id);
                break;
            case 'modifier':
                $id = $_GET['id'] ?? null;
                $recettesController->modifier($id);
                break;
            case 'supprimer':
                $id = $_GET['id'] ?? null;
                $recettesController->supprimer($id);
                break;
           case 'aApprouver':
                $recettesController->aApprouver();
                break;
            case 'approuver':
                $id = $_GET['id'];
                $recettesController->approuver($id);
                break;
            case 'enAttente':
                $recettesController->enAttente();
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    case 'user':
        switch ($action) {
            case 'enregistrer':
                $userController->enregistrer();
                break;
            case 'connexion':
                $userController->connexion();
                break;
            case 'verifie_connexion':
                $userController->verifie_connexion();
                break;
            case 'deconnexion':
                $userController->deconnexion();
                break;
            case 'profile':
                $userController->profile();
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    case 'favori':
        switch ($action) {
            case 'ajouter':
                $id = $_GET['id'];
                $favoriController->ajouter($id);
                break;
            case 'getFavoris':
                $favoriController->getFavoris();
                break;
            case 'favoris':
                $favoriController->favoris();
                break;
            case 'supprimer':
                $id = $_GET['id'];
                $favoriController->remove_favoris($id);
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    case 'comment':
        switch ($action) {
            case 'enregistrer':
                $id = $_GET['id'] ?? null;
                $commentController->enregistrer($id);
                break;
            case 'indexAdmin':
                $commentController->indexAdmin();
                break;
            case 'supprimer':
                $id = $_GET['id'] ?? null;
                $commentController->supprimer($id);
                break;
            default:
                require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
                break;
        }
        break;

    default:
        // Contrôleur non reconnu
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . '404Controller.php');
        break;
}


if (!isset($_GET["x"])) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'footer.php');
}
ob_end_flush();