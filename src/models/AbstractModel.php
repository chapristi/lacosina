<?php
namespace App\R301\Model;
use App\R301\Model\Database;
use PDO;

abstract class AbstractModel {
    protected $table; // Nom de la table (défini dans les classes filles)
    protected $pdo;
    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function findAll(): array {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findBy(array $params): array {
        $query = "SELECT * FROM {$this->table} WHERE ";
        foreach ($params as $key => $value) {
            $query .= "$key = :$key AND ";
        }
        $query = substr($query, 0, -5);
        $query = $this->pdo->prepare($query);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
