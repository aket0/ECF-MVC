<?php

namespace Model\entity;

use  Model\entity\Acteur;


/**
 * Description of Role
 *
 */
class Role
{

    private $acteur;
    private $id_Film;
    private $id;
    private $personnage;


    public function __construct(Acteur $acteur, int $id_Film, ?int $id, string $personnage)
    {
        $this->setActeur($acteur);
        $this->setID_Film($id_Film);
        $this->setId($id);
        $this->setPersonnage($personnage);
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
     * Get the value of id_Acteur
     */


    /**
     * Get the value of id_Film
     */
    public function getId_Film()
    {
        return $this->id_Film;
    }

    /**
     * Set the value of id_Film
     *
     * @return  self
     */
    public function setId_Film($id_Film)
    {
        $this->id_Film = $id_Film;

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
}
