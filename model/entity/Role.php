<?php

namespace Model\entity;

/**
 * Description of Role
 *
 */
class Role
{


    private $id;
    private $personnage;


    public function __construct($id, $personnage)
    {

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
}
