<?php

namespace App\R301\Model;
use PDO;
use App\R301\Model\AbstractModel;
class RecetteModel extends AbstractModel
{
    protected $table = 'lacosina.recettes';

    public function __construct()
    {
        parent::__construct();
    }

    public function insertRecette($titre, $description, $auteur, $image, $type)
    {

        $requete = $this->pdo->prepare("INSERT INTO {$this->table} (titre, description, auteur, date_creation, image, type_plat,isApproved) VALUES (:titre, :description, :auteur, NOW(), :image, :type_plat,:isApproved)");
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':auteur', $auteur);
        $requete->bindParam(':image', $image);
        $requete->bindParam(':type_plat', $type);
        if ($_SESSION['isAdmin'] == "1") {
            $isApproved = true;
        } else {
            $isApproved = false;
        }
        $requete->bindParam(':isApproved', $isApproved, PDO::PARAM_BOOL);

        return $requete->execute();
    }

    public function updateRecette($id, $titre, $description, $auteur, $image)
    {
        $requete = $this->pdo->prepare("UPDATE  {$this->table}  SET titre = :titre, description = :description, auteur = :auteur, image = :image WHERE id = :id");
        $requete->bindParam(':titre', $titre);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':auteur', $auteur);
        $requete->bindParam(':image', $image);
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        return $requete->execute();
    }

    public function deleteRecette($id)
    {
        $requete = $this->pdo->prepare("DELETE FROM {$this->table}  WHERE id = :id");
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        return $requete->execute();
    }


    public function getRecettesWithFavorites($userId, $filtre)
    {
        $requete = $this->pdo->prepare("
            SELECT r.*, 
                   CASE 
                       WHEN f.id IS NOT NULL THEN 1
                       ELSE 0
                   END AS is_favorite
            FROM  {$this->table} r
            LEFT JOIN favoris f ON f.recette_id = r.id AND f.user_id = :user_id
            WHERE :type_plat IS NULL OR type_plat = :type_plat
        ");

        $requete->execute([
            ':user_id' => $userId,
            'type_plat' => $filtre,
        ]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    function getRecettesToApprove(){

            $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE isApproved = 0");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    function approve($id){
        $query = $this->pdo->prepare("UPDATE {$this->table} SET isApproved = 1 WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    function enAttente($userId){

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE isApproved = 0");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
}