<?php

namespace Mvc\Controller;

use Config\Controller;
use Twig\Environment;

class AccueilController extends Controller
{
    public function displayAccueil()
    {
        // var_dump($_SESSION);
        echo $this->twig->render('accueil.html.twig');
    }

    public function displayArtcile()
    {
        // var_dump($_SESSION);
        echo $this->twig->render('articles.html.twig');
    }

    public function displayPropos()
    {
        // var_dump($_SESSION);
        echo $this->twig->render('propos.html.twig');
    }

    public function displayCreateArticle()
    {
        // var_dump($_SESSION);
        echo $this->twig->render('createArticle.html.twig');
    }

    public function displayAdmin()
    {
        // var_dump($_SESSION);
        echo $this->twig->render('admin.html.twig');
    }

}

