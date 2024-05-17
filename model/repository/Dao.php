<?php

namespace Model\repository;

use Model\repository\SPDO;

abstract class Dao
{
    protected static $bdd = null;

    public function __construct()
    {
        // Connexion à la base de données
        try {
            self::$bdd = SPDO::getInstance();
            self::$bdd->query("SET NAMES UTF8");
        } catch (\Exception $e) {
            echo "Problème de connexion à la base de données ...";
            die();
        }
    }

    // Récupérer tous les éléments
    abstract public static function getAll(string $recherche): array;

    // Récupérer plus d'informations sur un élément à l'aide de son ID
    abstract public static function getOne(int $id): ?object;

    // Ajouter un élément
    abstract public static function addOne(object $data): bool;

    // Supprimer un élément
    abstract public static function deleteOne(int $id): bool;

    // Modifier un élément
    abstract public static function updateOne(object $data): bool;
}
