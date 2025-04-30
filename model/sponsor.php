<?php

class Sponsor {
    private $id_sponsor;
    private $nom_entreprise;
    private $montant_sponsor;
    private $type_sponsor;
    private $date_acceptation;
    private $engagement;

    public function __construct($nom_entreprise, $montant_sponsor, $type_sponsor, $date_acceptation, $engagement) {
        $this->nom_entreprise = $nom_entreprise;
        $this->montant_sponsor = $montant_sponsor;
        $this->type_sponsor = $type_sponsor;
        $this->date_acceptation = $date_acceptation;
        $this->engagement = $engagement;
    }

    // Getters
    public function getIdSponsor() { return $this->id_sponsor; }
    public function getNomEntreprise() { return $this->nom_entreprise; }
    public function getMontantSponsor() { return $this->montant_sponsor; }
    public function getTypeSponsor() { return $this->type_sponsor; }
    public function getDateAcceptation() { return $this->date_acceptation; }
    public function getEngagement() { return $this->engagement; }

    // Setters
    public function setNomEntreprise($nom_entreprise) { $this->nom_entreprise = $nom_entreprise; }
    public function setMontantSponsor($montant_sponsor) { $this->montant_sponsor = $montant_sponsor; }
    public function setTypeSponsor($type_sponsor) { $this->type_sponsor = $type_sponsor; }
    public function setDateAcceptation($date_acceptation) { $this->date_acceptation = $date_acceptation; }
    public function setEngagement($engagement) { $this->engagement = $engagement; }
}
