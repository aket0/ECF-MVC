<?php

namespace Model\repository;

use Model\entity\Film;
use Model\entity\Role;
use Model\entity\Acteur;
use Model\repository\Dao;

class FilmDAO extends Dao
{

    //Récupérer tous les films
    public static function getAll(): array
    {

        $query = self::$bdd->prepare("SELECT * FROM film");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $roles = self::getRolesByFilm($data['id']);


            $films[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $roles);
        }
        // var_dump($films);
        return ($films);
    }

    //Ajouter un film
    public static function addOne($data): bool
    {

        $requete = 'INSERT INTO Film (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur, :affiche, :annee)';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    //fonction qui ajoute un film et qui me retourne l'id de l'insertion 
    public static function addOneFilm($data): ?int
    {

        $requete = 'INSERT INTO Film (titre, realisateur, affiche, annee) VALUES (:titre , :realisateur, :affiche, :annee)';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $insert = self::$bdd->prepare($requete);
        $insert->execute($valeurs);
        $last_insert_id = self::$bdd->lastInsertId();
        //var_dump($last_insert_id);
        return $last_insert_id;
    }

    //Récupérer plus d'info sur 1 film
    public static function getOne(int $id): Film
    {
        $query = self::$bdd->prepare('SELECT * FROM Film WHERE id = :id_film');
        $query->execute(array(':id_film' => $id));
        $data = $query->fetch();
        return new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
    }
    //rechercher un film par titre et année
    public static function getOneByTitre(string $titre, string $annee): ?Film
    {
        $query = self::$bdd->prepare('SELECT * FROM Film WHERE titre = :titre AND annee = :annee ');
        $query->execute(array(':titre' => $titre, ':annee' => $annee));
        $data = $query->fetch();
        if ($data) {
            return new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        } else return null;
    }

    //Deleter 1 film par son id
    public static function deleteOne(int $id): bool
    {
        $query = self::$bdd->prepare('DELETE FROM Film WHERE id_Film = :id_Film');
        $query->execute(array(':id_film' => $id));
        return $query->rowCount() == 1 ? true : false;
    }

    //Modifier un film
    public static function updateOne($data): bool
    {
        $requete = 'UPDATE Film set titre=:titre, realisateur = :realisateur, affiche = :affiche, annee = :annee WHERE id=:id';
        $valeurs = ['titre' => $data->getTitre(), 'realisateur' => $data->getRealisateur(), 'affiche' => $data->getAffiche(), 'annee' => $data->getAnnee()];
        $query = self::$bdd->prepare($requete);
        $query->execute($valeurs);
        return $query->rowCount() == 1 ? true : false;
    }

    //Ajouter un role
    public static function addOneRole($data): bool
    {
        $requete = 'INSERT INTO Role (id_Acteur , id_film , id,  personnage) VALUES (:id_Acteur , :id_film ,:id, :personnage)';
        var_dump($data->getActeur());
        $valeurs = ['id_Acteur' => $data->getActeur()->getId(), 'id_film' => $data->getId_Film(), 'id' => $data->getId(), 'personnage' => $data->getPersonnage()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }


    public static function getRolesByFilm(int $idFilm): array
    {
        $query = self::$bdd->prepare('SELECT Role.*, Acteur.nom AS nom_acteur, Acteur.prenom AS prenom_acteur FROM Role INNER JOIN Acteur ON Role.id_Acteur = Acteur.id WHERE id_Film = :idFilm');
        $query->execute([':idFilm' => $idFilm]);
        $roles = [];

        while ($data = $query->fetch()) {
            $acteur = new Acteur($data['id_Acteur'], $data['nom_acteur'], $data['prenom_acteur']);
            $role = new Role($acteur, $data['id_Film'], $data['id'], $data['personnage']);
            $roles[] = $role;
        }

        return $roles;
    }
    // Rechercher un film par titre

    public static function searchOne(string $titre): array
    {
        $query = self::$bdd->prepare('SELECT * FROM Film WHERE titre LIKE :titre');
        $query->execute(array(':titre' => '%' . $titre . '%'));
        $films = array();
        if ($query->rowCount() != 0) {
            while ($data = $query->fetch()) {
                $films[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
            }
        }

        return ($films);
    }
}
