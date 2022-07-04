<?php

namespace Mvc\Controller;

use Config\Controller;
use Mvc\Model\UserModel;
use Twig\Environment;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $from = $_FILES['image']['tmp_name'];
            $to = __DIR__ . '/../../public/images/' . $_FILES['image']['name'];
            if (move_uploaded_file($from, $to))
            {
                $this->userModel->createUser($_POST['firstname'], $_POST['mail'], password_hash($_POST['password'], PASSWORD_DEFAULT));
            }

            header('location: /inscription.html.twig');
            exit();
        }
        echo $this->twig->render('inscription.html.twig');
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail']) && isset($_POST['password'])) {
            $account = $this->userModel->loginIn($_POST['mail']);
            if (isset($_POST['password']) && isset($account['password']) && password_verify($_POST['password'], $account['password'])) {

                $_SESSION['user'] = [
                    'lastname' => $account['lastname'],
                    'mail' => $account['mail'],
                    'password' => $_POST['password'],
                    
                ];
                header('Location: /');
                exit();
            }
        }

        echo $this->twig->render('base.html.twig');
    }

    public function updateProfil()
    {
        var_dump($_SESSION);
        $account = $this->userModel->loginIn($_SESSION['user']['mail']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $from = $_FILES['image']['tmp_name'];
            $to = __DIR__ . '/../../public/images/' . $_FILES['image']['name'];

            if(strlen($_FILES['image']['name']) === 0){
                $_Files['image']['name'] = $_SESSION['user']['image1'];
            }



            $this->userModel->updateProfil($_POST['firstname'], $_POST['mail'], password_hash($_POST['password'], PASSWORD_DEFAULT));
            
            $_SESSION['user'] = [
                'firstname' => $_POST['firstname'],

                'mail' => $_POST['mail'],
                'password' => $_POST['password'],
            ];
            
            header('location: /');
            exit();
        }
        echo $this->twig->render('profil.html.twig');
    }




    public function ListUsers() {
        $users = $this->userModel->findAll();
        echo $this->twig->render('accueil.html.twig', ['users' => $users]);
    }


}