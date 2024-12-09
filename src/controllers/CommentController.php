<?php
namespace App\R301\Controller;

use App\R301\Model\CommentModel;
use Exception;
class CommentController
{
    private CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function lister($id)
    {
        $comments = $this->commentModel->getCommentsByRecipeId($id);
        return $comments;
    }

    public function indexAdmin(): void
    {
        if ($_SESSION['isAdmin'] == "1") {
            $comments = $this->commentModel->getAllComments();
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'commentaires' . DIRECTORY_SEPARATOR . 'liste.php';
        } else {
            header('location: ?url=home');
        }
    }

    public function supprimer($id): void
    {
        if ($_SESSION['isAdmin'] == "1") {
            if ($this->commentModel->deleteComment($id)) {
                $_SESSION['message'] = ["success" => "Le commentaire a bien été supprimé"];
            }
        }
    }

    public function enregistrer($id): void
    {
        try {
            $id = (int)$id;
            $pseudo = empty($_SESSION['identifiant']) ? 'Anonym' : $_SESSION['identifiant'];
            if ($this->commentModel->addComment($id, $pseudo, $_POST['comment'])) {
                header('Location: ?url=recettes&a=detail&id=' . $id);
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
