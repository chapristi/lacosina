<?php
namespace App\R301\Controller;
use App\R301\Model\RecetteModel;
use App\R301\Model\FavoriModel;
use Exception;
use PDOException;
class RecetteController
{
    private RecetteModel $recetteModel;
    private FavoriModel $favoriModel;



    public function __construct()
    {
        $this->recetteModel = new RecetteModel();
        $this->favoriModel = new FavoriModel();

    }

    public function ajouter()
    {
        require_once __DIR__ . '/../views/recettes/ajout.php';
    }

    public function enregistrer()

    {
        var_dump($_POST);
        try {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $auteur = $_POST['email'] ?? '';
            $type = $_POST['type'] ?? '';

            if (empty($titre) || empty($description) || empty($auteur)) {
                throw new Exception("Tous les champs obligatoires doivent être remplis.");
            }

            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $dossierCible = './upload/';
                $nomImage = uniqid() . '-' . basename($_FILES['image']['name']);
                $cheminImage = $dossierCible . $nomImage;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage)) {
                    $image = $cheminImage;
                } else {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
            }

            $ajoutOk = $this->recetteModel->insertRecette($titre, $description, $auteur, $image, $type);

            if ($ajoutOk) {
                require_once __DIR__ . '/../views/recettes/enregistrer.php';
            } else {
                throw new Exception("Erreur lors de l'enregistrement de la recette.");
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function index($filtre = null)
    {
        if (isset($_SESSION['id'])) {
            $recipes  = $this->recetteModel->getRecettesWithFavorites($_SESSION['id'], $filtre);
        } else {
            $recipes = $this->recetteModel->findAll();

        }
        require_once __DIR__ . '/../views/recettes/liste.php';
    }

    public function detail($id)
    {
        try {
            $favoriController = new FavoriController();
            $commentaireController = new CommentController();

            $isFav = $favoriController->exist($id);
            var_dump($isFav);
            $recipe = $this->recetteModel->find($id);

            if (empty($recipe)) {
                header('Location: ?url=home');
                exit();
            }

            $commentaires = $commentaireController->lister($id);
            require_once __DIR__ . '/../views/recettes/details.php';
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function modifier($id)
    {
        try {
            $result = $this->recetteModel->find($id);
            if (!$result) {
                throw new Exception("Recette introuvable.");
            }

            $titre = $_POST['titre'] ?? $result['titre'];
            $description = $_POST['description'] ?? $result['description'];
            $auteur = $_POST['email'] ?? $result['auteur'];
            $image = $result['image'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $dossierCible = 'upload/';
                $nomImage = uniqid() . '-' . basename($_FILES['image']['name']);
                $cheminImage = $dossierCible . $nomImage;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage)) {
                    $image = $cheminImage;
                } else {
                    throw new Exception("Erreur lors du téléchargement de l'image.");
                }
            }

            $modificationOk = $this->recetteModel->updateRecette($id, $titre, $description, $auteur, $image);

            if ($modificationOk) {
                require_once __DIR__ . '/../views/recettes/validationModif.php';
            } else {
                throw new Exception("Erreur lors de la mise à jour de la recette.");
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function afficherFormulaireModification($id)
    {
        $recette = $this->recetteModel->find($id);
        if (!$recette) {
            echo "Recette introuvable.";
            return;
        }
        require_once __DIR__ . '/../views/recettes/modif.php';
    }

    public function supprimer($id)
    {
        try {
            if (empty($id)) {
                throw new Exception("Identifiant de recette manquant.");
            }
            $this->recetteModel->deleteRecette($id);
            $this->favoriModel->removeFavoriWithId($id);

            require_once __DIR__ . '/../views/recettes/suprimer.php';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function indexJSON()
    {
        header('Content-Type: application/json');
        echo json_encode($this->recetteModel->findAll());
    }

    public function aApprouver(){
        $recettes = $this->recetteModel->getRecettesToApprove();
        require_once __DIR__ . '/../views/recettes/aApprouver.php';
    }

    public function approuver($id){
        $recettes = $this->recetteModel->approve($id);
        header('Location: ?url=recettes&a=aApprouver');
    }

    public function enAttente(){
        $recettes = $this->recetteModel->enAttente($_SESSION['id']);
        require_once __DIR__ . '/../views/recettes/enAttente.php';
    }
}
