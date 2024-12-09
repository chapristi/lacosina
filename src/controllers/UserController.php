<?php
namespace App\R301\Controller;
use App\R301\Model\UserModel;

class UserController
{

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function enregistrer()
    {

        if (
            isset($_POST['email'], $_POST['identifiant'], $_POST['password']) &&
            !empty($_POST['email']) && !empty($_POST['identifiant']) && !empty($_POST['password'])
        ) {


            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = htmlspecialchars($_POST['email']);
            $identifiant = htmlspecialchars($_POST['identifiant']);

            $estOK = $this->userModel->createUser($email, $identifiant, $hashedPassword);


            if ($estOK){
                require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'enregistrement.php';
            }
        }
        else{
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'inscription.php';

        }
    }

    public function connexion(){
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'connexion.php';

    }
    public function verifie_connexion()
    {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $password = $_POST['password'];

        $user = $this->userModel->getUserByIdentifiant($identifiant);
    
    
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['identifiant'] = $user['identifiant'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            header('Location: ?url=user&a=profile');
            exit;
        } else {
            echo "Erreur : identifiant ou mot de passe incorrect.";
        }
    }
    
    public  function deconnexion(){
        session_destroy();
    
        header('Location: ?url=home');
        exit();
    }
    public  function profile(){
        if(empty($_SESSION['id'])){
            header('Location: ?url=home');
            exit(); 
        }
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'profile.php';

    }
}
