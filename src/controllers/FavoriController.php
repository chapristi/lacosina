<?php
namespace App\R301\Controller;
use App\R301\Model\FavoriModel;
class FavoriController
{

    private FavoriModel $favoriModel;

    public function __construct()
    {
       $this->favoriModel = new FavoriModel();
    }

    public function ajouter($id)
    {


        $count = $this->favoriModel->countFavorisByRecette($_SESSION['id'],$id);
        var_dump($count);
        if ($count == 0) {
            $this->favoriModel->addFavori($_SESSION['id'], $id);
        }
        $_SESSION['message'] = ["success" => "la rectte a etait ajouté aux favoris"];
        header('Location: ?url=recettes&a=detail&id=' . $id);

    }

    public function getFavoris ()
    {
        header('Content-Type: application/json');
        echo json_encode($this->favoriModel->getFavorisByUser((int) $_SESSION['id']));

    }

    public function favoris()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'fav.php';
    }

    public function remove_favoris($recette_id)
    {
        if (isset($_SESSION['id'])) {
            $this->favoriModel->removeFavori($_SESSION['id'], $recette_id);
        }
        $_SESSION['message'] = ["success" => "la rectte a etait retiré des favoris"];
        header('Location: ?url=recette&a=detail&id=' . $recette_id);

    }

    public function exist($recette_id) : bool
    {
        return $this->favoriModel->exists($_SESSION['id'], $recette_id);
    }

}
