<?php

namespace Model\entity;

use Model\entity\Film;
use Model\entity\Acteur;

/**
 * Description of Role
 *
 */
class Role
{

    private $id;
    private $personnage;
    private $acteur;
    private $film;


    public function __construct($id, $personnage, Acteur $acteur, Film $film)
    {
        $this->setId($id);
        $this->setPersonnage($personnage);
        $this->setActeur($acteur);
        $this->setFilm($film);
    }


    /**
     * Get the value of personnage
     */
    public function getPersonnage()
    {
        return $this->personnage;
    }

    /**
     * Set the value of personnage
     *
     * @return  self
     */
    public function setPersonnage($personnage)
    {
        $this->personnage = $personnage;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of acteur
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * Set the value of acteur
     *
     * @return  self
     */
    public function setActeur($acteur)
    {
        $this->acteur = $acteur;

        return $this;
    }

    /**
     * Get the value of film
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set the value of film
     *
     * @return  self
     */
    public function setFilm($film)
    {
        $this->film = $film;

        return $this;
    }
}
