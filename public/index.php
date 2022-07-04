<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new \Bramus\Router\Router();

$router->before('GET', '/login', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/inscription', function() {
    if (isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

$router->before('GET', '/propos', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /');
        exit();
    }
});

$router->before('GET', '/createArticle', function() {
    if ($_SESSION['user']['role'] != 'admin') {
        header('location: /login');
        exit();
    }
});

$router->before('GET', '/admin', function() {
    if ($_SESSION['user']['role'] != 'admin') {
        header('location: /login');
        exit();
    }
});

$router->get('/login', 'Mvc\Controller\UserController@login');
$router->post('/login', 'Mvc\Controller\UserController@login');

$router->get('/inscription', 'Mvc\Controller\UserController@createUser');
$router->post('/inscription', 'Mvc\Controller\UserController@createUser');

$router->get('/', 'Mvc\Controller\UserController@ListUsers');
$router->get('/article', 'Mvc\Controller\ArticleController@ArticleList');

$router->get('/propos', 'Mvc\Controller\AccueilController@Propos');

$router->get('/admin/createArticle', 'Mvc\Controller\ArticleController@listArticle');
$router->post('/admin/createArticle/deleteArticle', 'Mvc\Controller\ArticleController@deleteArticle');
$router->post('/admin/createArticle', 'Mvc\Controller\ArticleController@createArticle');



$router->get('/admin', 'Mvc\Controller\AccueilController@displayAdmin');


$router->run();

?>