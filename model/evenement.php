<?php

class Evenement
{
    private $id = null;
    private $nom = null;
    private $organisateur = null;
    private $description = null;
    private $type = null;
    private $date = null;
    private $place = null;

    // Constructor
    public function __construct($nom, $organisateur, $description, $type, $date, $place)
    {
        $this->nom = $nom;
        $this->organisateur = $organisateur;
        $this->description = $description;
        $this->type = $type;
        $this->date = $date;
        $this->place = $place;
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getOrganisateur()
    {
        return $this->organisateur;
    }
    public function setOrganisateur($organisateur)
    {
        $this->organisateur = $organisateur;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPlace()
    {
        return $this->place;
    }
    public function setPlace($place)
    {
        $this->place = $place;
    }
}
