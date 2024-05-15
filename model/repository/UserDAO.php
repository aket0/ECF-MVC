<?php

namespace Model\repository;
use Model\repository\Dao;
use Model\entity\User;

class UserDAO extends Dao
{   

    
    public static function getAll(): array
    {
        $query = self::$bdd->prepare("SELECT id, username, email, mdp FROM user");
        $query->execute();
        $users = [];

        while ($data = $query->fetch()) {
            $users[] = new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return $users;
    }

    
    public static function addOne(object $data): bool
    {
        if (!$data instanceof User) {
            throw new \InvalidArgumentException('Expected instance of User');
        }

        $requette = 'INSERT INTO user (username, email, password) VALUES (:username, :email, :password)';
        $values = [
            'username' => $data->getUsername(),
            'email' => $data->getEmail(),
            'password' => password_hash($data->getPassword(), PASSWORD_DEFAULT),
        ];
        $insert = self::$bdd->prepare($requette);
        return $insert->execute($values);
        
    }
    
    public static function getOne(int $id): User
    {
        $query = self::$bdd->prepare('SELECT * FROM user WHERE id = :id');
        $query->execute([':id' => $id]);
        $data = $query->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return null;
    }

    
    public static function getByEmail(string $email): ?User
    {
        $query = self::$bdd->prepare('SELECT * FROM user WHERE email = :email');
        $query->execute([':email' => $email]);
        $data = $query->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email'], $data['password']);
        }
        return null;
    }

    // Supprimer un utilisateur
    public static function deleteOne(int $id): bool
    {
        $query = self::$bdd->prepare('DELETE FROM user WHERE id = :id');
        return $query->execute([':id' => $id]);
    }

    // Modifier un utilisateur
    public static function updateOne(object $user): bool
    {
        if (!$user instanceof User) {
            throw new \InvalidArgumentException('Expected instance of User');
        }

        $query = 'UPDATE User SET username = :username, email = :email, password = :password WHERE id = :id';
        $values = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
        ];
        $update = self::$bdd->prepare($query);
        return $update->execute($values);
    }
}
