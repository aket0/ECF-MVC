<?php

namespace Model\repository;

use Model\entity\User;
use Model\repository\Dao;

class UserDAO extends Dao
{

    //Récupérer tous les User
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT id, username, email, password FROM User");
        $query->execute();
        $user = array();

        while ($data = $query->fetch()) {
            $user[] = new User($data['id'], $data['username'], $data['email'],$data['password']);
        }
        return ($user);
    }

    //Ajouter un User
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO User (username, email, password) VALUES (:username , :email, :password)';
        $valeurs = ['username' => $data->getUsername(), 'email' => $data->getEmail(), 'password' => $data->getPassword()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer plus d'info sur 1 User,
    public static function getOne(int $id): User
    {
        $query = self::$bdd->prepare('SELECT * FROM user WHERE id = :id_user');
        $query->execute(array(':id_user' => $id));
        $data = $query->fetch();
        return new user($data['id'], $data['username'], $data['email']);
    }

   
    
}
