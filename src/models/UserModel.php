<?php
namespace App\R301\Model;
use PDO;
use App\R301\Model\AbstractModel;
class UserModel extends AbstractModel
{
    protected $table = 'lacosina.users';


    public function __construct()
    {
        parent::__construct();
    }
    public function createUser(string $email, string $identifiant, string $hashedPassword): bool
    {
        $sql = "
            INSERT INTO lacosina.users (mail, identifiant, password, create_time, isAdmin) 
            VALUES (:mail, :identifiant, :password, NOW(), 0)
        ";
        $requete = $this->pdo->prepare($sql);
        return $requete->execute([
            ':mail' => $email,
            ':identifiant' => $identifiant,
            ':password' => $hashedPassword
        ]);
    }

    public function getUserByIdentifiant(string $identifiant): ?array
    {
        $sql = "SELECT * FROM lacosina.users WHERE identifiant = :identifiant";
        $requete = $this->pdo->prepare($sql);
        $requete->execute([':identifiant' => $identifiant]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
}
