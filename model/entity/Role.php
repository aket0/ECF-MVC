<?php

namespace Model\entity;



/**
 * Description of Role
 *
 */
class Role
{

    private $id_Acteur;
    private $id_Film;
    private $id;
    private $personnage;


    public function __construct(int $id_Acteur, int $id_Film, int $id, string $personnage)
    {
        $this->setID_Acteur($id_Acteur);
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
    public function getId_Acteur()
    {
        return $this->id_Acteur;
    }

    /**
     * Set the value of id_Acteur
     *
     * @return  self
     */
    public function setId_Acteur($id_Acteur)
    {
        $this->id_Acteur = $id_Acteur;

        return $this;
    }

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
}
