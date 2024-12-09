<?php
namespace App\R301\Model;
use PDO;
use PDOException;
use App\R301\Model\AbstractModel;
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $dbname = "lacosina";
    private $conn;

    /**
     * Récupère la connexion à la base de données
     *
     * @return PDO|null
     */
    public function getConnection()
    {
        $this->conn = null;
        try {
            // Créer la connexion avec PDO
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->user, $this->password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active le mode d'erreur pour les exceptions PDO
            ]);
        } catch (PDOException $e) {
            // Afficher un message d'erreur précis en cas d'échec
            die("Échec de la connexion : " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
