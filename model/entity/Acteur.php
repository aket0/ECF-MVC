<?php

namespace Model\entity;

/**
 * Description de Acteur
 *
 */
class Offre
{
    private $id;
    private $nom;
    private $prenom;

    public function __construct($id, $nom, $prenom)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
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
     */ 
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     * commentaire 
     *
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;
     
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

    }
}