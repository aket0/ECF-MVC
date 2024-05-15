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

        $query = self::$bdd->prepare("SELECT * FROM Film");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $films[] = new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
        }
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

    //Récupérer plus d'info sur 1 film
    public static function getOne(int $id): Film
    {
        $query = self::$bdd->prepare('SELECT * FROM Film WHERE id = :id_film');
        $query->execute(array(':id_film' => $id));
        $data = $query->fetch();
        return new Film($data['id'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
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
        $requete = 'INSERT INTO Role (personnage) VALUES (:personnage) WHERE id_Film = :id_Film AND id_Acteur = :id_Acteur ';
        $valeurs = ['personnage' => $data->getPersonnage()];
        $insert = self::$bdd->prepare($requete);
        return $insert->execute($valeurs);
    }

    public static function getRole(int $idFilm, int $idRole): ?Role
    {
        $query = self::$bdd->prepare('SELECT * FROM Role WHERE id_Film = :idFilm AND id = :idRole');
        $query->execute([':idFilm' => $idFilm, ':idRole' => $idRole]);
        $data = $query->fetch();

        if ($data) {
            return new Role($data['id_Acteur'], $data['id_Film'], $data['id'], $data['personnage']);
        } else {
            return null;
        }
    }
    public function getRolesByFilm(int $idFilm): array
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
