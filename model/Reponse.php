<?php

class Reponse
{
    private $id_reponse = null;
    private $date_reponse = null;
    private $message = null;
    private $id_reclamation = null;

    // Constructor
    public function __construct($date_reponse, $message, $id_reclamation)
    {
        $this->date_reponse = $date_reponse;
        $this->message = $message;
        $this->id_reclamation = $id_reclamation;
    }

    // Getters and Setters
    public function getIdReponse()
    {
        return $this->id_reponse;
    }

    public function setIdReponse($id_reponse)
    {
        $this->id_reponse = $id_reponse;
    }

    public function getDateReponse()
    {
        return $this->date_reponse;
    }

    public function setDateReponse($date_reponse)
    {
        $this->date_reponse = $date_reponse;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getIdReclamation()
    {
        return $this->id_reclamation;
    }

    public function setIdReclamation($id_reclamation)
    {
        $this->id_reclamation = $id_reclamation;
    }
}
