<?php

namespace App\R301\Model;
use PDO;
use App\R301\Model\AbstractModel;
class FavoriModel extends AbstractModel
{
    protected $table = 'lacosina.favoris';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ajoute un favori dans la base de données.
     *
     * @param int $userId
     * @param int $recetteId
     * @return bool
     */
    public function addFavori(int $userId, int $recetteId): bool
    {
        $sql = "INSERT INTO {$this->table} (recette_id, user_id, create_time) VALUES (:recette_id, :user_id, NOW())";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ':recette_id' => $recetteId,
            ':user_id' => $userId
        ]);
    }

    /**
     * Supprime un favori.
     *
     * @param int $userId
     * @param int $recetteId
     * @return bool
     */
    public function removeFavori(int $userId, int $recetteId): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE recette_id = :recette_id AND user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ':recette_id' => $recetteId,
            ':user_id' => $userId
        ]);
    }

    public function removeFavoriWithId(int $recetteId): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE recette_id = :recette_id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ':recette_id' => $recetteId,
        ]);
    }

    /**
     * Vérifie si un favori existe pour un utilisateur donné.
     *
     * @param int $userId
     * @param int $recetteId
     * @return bool
     */
    public function exists(int $userId, int $recetteId): bool
    {
        $sql = "SELECT 1 FROM {$this->table} WHERE recette_id = :recette_id AND user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':recette_id' => $recetteId,
            ':user_id' => $userId
        ]);
        return $query->fetchColumn() !== false;
    }

    /**
     * Récupère tous les favoris d'un utilisateur donné.
     *
     * @param int $userId
     * @return array
     */
    public function getFavorisByUser(int $userId): array
    {
        $sql = "SELECT r.* FROM {$this->table} f JOIN recettes r ON f.recette_id = r.id WHERE f.user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':user_id' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre de fois qu'une recette est ajoutée en favori.
     *
     * @param int $recetteId
     * @return int
     */
    public function countFavorisByRecette(int $userId,int $recetteId): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE recette_id = :recette_id AND user_id = :user_id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':recette_id' => $recetteId,
            ":user_id" => $userId,
        ]);
        return (int)$query->fetchColumn();
    }
}
