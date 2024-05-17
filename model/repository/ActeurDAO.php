<?php

namespace Model\repository;

use Model\entity\Acteur;
use Model\repository\Dao;

class ActeurDAO extends Dao
{

    //Récupérer tous les acteurs
    public static function getAll(string $recherche=""): array
    {

        $query = self::$bdd->prepare("SELECT id, nom, prenom FROM acteur");
        $query->execute();
        

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
        
        return ($insert->execute($valeurs));
    }
    //
    public static function addOneActeur($data): ?int
    {

        $requete = 'INSERT INTO acteur (nom, prenom) VALUES (:nom , :prenom)';
        $valeurs = ['nom' => $data->getNom(), 'prenom' => $data->getPrenom()];
        $insert = self::$bdd->prepare($requete);
        
        $insert->execute($valeurs);
    
        $last_insert_id = self::$bdd->lastInsertId();
            //var_dump($last_insert_id);
        return $last_insert_id;
        
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
        $query = self::$bdd->prepare('DELETE FROM acteur WHERE id = :idActeur');
        $query->execute(array(':idActeur' => $id));
        return $query->rowCount() == 1 ? true : false;
    }

    //Modifier un acteur
    public static function updateOne($data): bool
    {
        $requete = 'UPDATE acteur set nom=:nom, prenom=:prenom WHERE id=:id';
        $valeurs = ['id' => $data->getId(), 'nom' => $data->getnom(), 'prenom' => $data->getprenom()];
        $query = self::$bdd->prepare($requete);
        $query->execute($valeurs);
        return $query->rowCount() == 1 ? true : false;
    }

    //chercher un acteur par nom, prenom
    public static function getActeurByName (string $nom, string $prenom) : ?Acteur
    {
        $query = self::$bdd->prepare('SELECT * FROM acteur WHERE nom = :nom AND prenom = :prenom');
        $query->execute(array(':nom' => $nom, ':prenom' => $prenom));
        $data = $query->fetch();
    
        if ($data) {
            return new Acteur($data['id'], $data['nom'], $data['prenom']);
        }
        return null;
       

    }
}
