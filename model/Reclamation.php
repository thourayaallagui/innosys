<?php

class Reclamation
{
    private $id_reclamation = null;
    private $date_creation = null;
    private $objet = null;
    private $statut = null;
    private $user_id = null;

    // Constructor
    public function __construct($date_creation, $objet, $statut, $user_id)
    {
        $this->date_creation = $date_creation;
        $this->objet = $objet;
        $this->statut = $statut;
        $this->user_id = $user_id;
    }

    // Getters and Setters
    public function getIdReclamation()
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation($id_reclamation)
    {
        $this->id_reclamation = $id_reclamation;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function getObjet()
    {
        return $this->objet;
    }

    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
