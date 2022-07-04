<?php

namespace Mvc\Model;

use Config\Model;

use PDO;

class UserModel extends Model
{

    public function createUser(string $firstname, string $mail, string $password) 
    {

        $statement = $this->pdo->prepare('INSERT INTO `user` (`firstname`, `mail`, `password` )');

        $statement->execute([
            'firstname' => $firstname,
            'mail' => $mail,
            'password' => $password,
        ]);
    }

    public function loginIn(string $mail) {

        $statement = $this->pdo->prepare('SELECT * FROM `user` WHERE `mail` = :mail');

        $statement->execute([
            'mail' => $mail,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function Subscription(string $subscritpion) 
    {

        $statement = $this->pdo->prepare('UPDATE `user` SET `subscription` = :subscritpion');

        $statement->execute([
            'subscritpion' => $subscritpion,

        ]);
    }

    public function findAll() {

        $statement = $this->pdo->prepare('SELECT * FROM `user`');

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


}