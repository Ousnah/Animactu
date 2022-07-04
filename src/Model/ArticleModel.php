<?php

namespace Mvc\Model;

use Config\Model;

use PDO;

class ArticleModel extends Model
{

    public function ArticleList() {

        $statement = $this->pdo->prepare('SELECT * FROM `article`');

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public function createArticle(string $title, string $image, string $bio, string $date) 
    {

        $statement = $this->pdo->prepare('INSERT INTO `article` (`title`, `image`, `bio`, `date`, ) VALUES (:title, :image, :bio, :date )');

        $statement->execute([
            'title' => $title,
            'image' => $image,
            'bio' => $bio,
            'date' => $date,
            
        ]);
    }


    public function deleteArticle($id) 
    {

        $statement = $this->pdo->prepare('DELETE FROM `article` WHERE `id` = :id');

        $statement->execute([
            'id' => $id,
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateArticle(string $title, string $image, string $bio, string $date) 
    {
        $statement = $this->pdo->prepare('UPDATE `article` SET `title` = :title, `image` = :image, `bio` = :bio,`date` = :date');

        $statement->execute([
            'title' => $title,
            'image' => $image,
            'bio' => $bio,
            'date' => $date,
        ]);
    }


}