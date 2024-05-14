<?php

namespace Model\repository;

use Model\entity\User;
use PDO;
use PDOException;

class UserDAO extends Dao
{
    // Récupérer tous les utilisateurs
    public static function getAll(): array
    {
        $query = self::$bdd->prepare("SELECT id, username, email, password FROM User");
        $query->execute();
        $users = [];

        while ($data = $query->fetch()) {
            $users[] = new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return $users;
    }

    // Ajouter un utilisateur
    public static function addOne(User $user): bool
    {
        $query = 'INSERT INTO User (username, email, password) VALUES (:username, :email, :password)';
        $values = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
        ];
        $insert = self::$bdd->prepare($query);
        return $insert->execute($values);
    }

    // Récupérer un utilisateur par ID
    public static function getOne(int $id): ?User
    {
        $query = self::$bdd->prepare('SELECT * FROM User WHERE id = :id');
        $query->execute([':id' => $id]);
        $data = $query->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return null;
    }

    // Récupérer un utilisateur par email
    public static function getByEmail(string $email): ?User
    {
        $query = self::$bdd->prepare('SELECT * FROM User WHERE email = :email');
        $query->execute([':email' => $email]);
        $data = $query->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return null;
    }
}
