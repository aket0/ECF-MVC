<?php

namespace Model\repository;

use Model\entity\Acteur;
use Model\repository\Dao;

class ActeurDAO extends Dao
{

    //Récupérer tous les acteurs
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT id, nom, prenom FROM acteur");
        $query->execute();
        $offres = array();

        while ($data = $query->fetch()) {
            $acteurs[] = new Acteur($data['id'], $data['nom'], $data['prenom']);
        }
        return ($acteurs);
    }

    //Ajouter un Acteur
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO acteur (nom, prenom) VALUES (:nom , :prenom)';
        $valeurs = ['nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //Récupérer plus d'info sur 1 Acteur,
    public static function getOne(int $id): Acteur
    {
        $query = self::$bdd->prepare('SELECT * FROM acteur WHERE id = :id_acteur');
        $query->execute(array(':id_acteur' => $id));
        $data = $query->fetch();
        return new Acteur($data['id'], $data['nom'], $data['prenom']);
    }

    //Deleter 1 Acteur par son id
    public static function deleteOne(int $id): bool
    {
        $query = self::$bdd->prepare('DELETE FROM acteur WHERE acteur.id = :idActeur');
        $query->execute(array(':idActeur' => $id));
        return $query->rowCount() == 1 ? true : false;
    }

    //Modifier un acteur
    public static function updateOne($data): bool
    {
        $requete = 'UPDATE acteur set title=:title, description=:description WHERE id=:id';
        $valeurs = ['id' => $data->getId(), 'title' => $data->getTitle(), 'description' => $data->getDescription()];
        $query = self::$bdd->prepare($requete);
        $query->execute($valeurs);
        return $query->rowCount() == 1 ? true : false;
    }
}
