<?php

class Reservation
{
    private $id = null;
    private $nomClient = null;
    private $emailClient = null;
    private $telClient = null;
    private $dateReservation = null;
    private $event_id = null; // Added event_id property

    // Constructor
    public function __construct($nomClient, $emailClient, $telClient, $dateReservation, $event_id)
    {
        $this->nomClient = $nomClient;
        $this->emailClient = $emailClient;
        $this->telClient = $telClient;
        $this->dateReservation = $dateReservation;
        $this->event_id = $event_id; // Initialize event_id
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

    public function getNomClient()
    {
        return $this->nomClient;
    }
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;
    }

    public function getEmailClient()
    {
        return $this->emailClient;
    }
    public function setEmailClient($emailClient)
    {
        $this->emailClient = $emailClient;
    }

    public function getTelClient()
    {
        return $this->telClient;
    }
    public function setTelClient($telClient)
    {
        $this->telClient = $telClient;
    }

    public function getDateReservation()
    {
        return $this->dateReservation;
    }
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;
    }

    // Getter and Setter for event_id
    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }
}
