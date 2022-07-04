<?php

namespace Mvc\Controller;

use Config\Controller;
use Mvc\Model\ArticleModel;
use Twig\Environment;

class ArticleController extends Controller
{
    private ArticleModel $articleModel;

    public function __construct() {
        parent::__construct();
        $this->articleModel = new ArticleModel();
    }

    public function ArticleList() {
        $articles = $this->articleModel->ArticleList();
        echo $this->twig->render('articles.html.twig', ['articles' => $articles]);
    }


    public function listArticle() {
        $articles = $this->articleModel->ArticleList();
        echo $this->twig->render('createArticle.html.twig', ['articles' => $articles]);
    }


    public function createArticle()
    {
        if (isset($_POST)){
            $from = $_FILES['image']['tmp_name'];
            $to = __DIR__ . '/../../public/images/' . $_FILES['image']['name'];
            if (move_uploaded_file($from, $to))
            {
                $this->articleModel->createArticle($_POST['title'], $_FILES['image'], $_POST['bio'], $_POST['date']);
            }
            header('location: /admin/createArticle');
            exit();
        }
        echo $this->twig->render('createArticle.html.twig');
    }

    public function Propos() {
        $articles = $this->articleModel->Propos();
        echo $this->twig->render('propos.html.twig');
    }

    public function updateArticle(){
        if(isset($_POST)){
            $this->articleModel->updateArticle(key($_POST));
            header('location: /admin/createArticle');
            exit();
        }
    }

    public function deleteArticle(){
        if(isset($_POST)){
            $this->articleModel->deleteArticle(key($_POST));
            header('location: /admin/createArticle');
            exit();
        }
    }


    
}