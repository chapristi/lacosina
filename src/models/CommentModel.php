<?php
namespace App\R301\Model;
use PDO;
use App\R301\Model\AbstractModel;
class CommentModel extends AbstractModel
{
    protected $table = 'lacosina.comment';


    public function __construct()
    {
        parent::__construct();
    }

    public function getCommentsByRecipeId(int $recipeId): array
    {
        $requete = $this->pdo->prepare("SELECT * FROM comment WHERE recette_id = :recette_id");
        $requete->bindParam(":recette_id", $recipeId);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllComments(): array
    {
        $requete = $this->pdo->prepare("SELECT * FROM comment");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment(int $commentId): bool
    {
        $requete = $this->pdo->prepare("DELETE FROM comment WHERE id = :id");
        $requete->bindParam(":id", $commentId);
        return $requete->execute();
    }

    public function addComment(int $recipeId, string $pseudo, string $comment): bool
    {
        $requete = $this->pdo->prepare("
            INSERT INTO lacosina.comment (pseudo, recette_id, commentaire, create_time)
            VALUES (:pseudo, :recette_id, :commentaire, NOW())
        ");
        return $requete->execute([
            ":pseudo" => $pseudo,
            ":recette_id" => $recipeId,
            ":commentaire" => $comment
        ]);
    }
}
