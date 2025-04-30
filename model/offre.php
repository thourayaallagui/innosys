<?php

class Offre {
    private $id_offre;
    private $titre;
    private $description;
    private $montant_reduction;
    private $date_debut;
    private $date_fin;
    private $conditions;
    private $id_spons;

    public function __construct($titre, $description, $montant_reduction, $date_debut, $date_fin, $conditions, $id_spons) {
        $this->titre = $titre;
        $this->description = $description;
        $this->montant_reduction = $montant_reduction;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->conditions = $conditions;
        $this->id_spons = $id_spons;
    }

    // Getters
    public function getIdOffre() { return $this->id_offre; }
    public function getTitre() { return $this->titre; }
    public function getDescription() { return $this->description; }
    public function getMontantReduction() { return $this->montant_reduction; }
    public function getDateDebut() { return $this->date_debut; }
    public function getDateFin() { return $this->date_fin; }
    public function getConditions() { return $this->conditions; }
    public function getIdSpons() { return $this->id_spons; }

    // Setters
    public function setTitre($titre) { $this->titre = $titre; }
    public function setDescription($description) { $this->description = $description; }
    public function setMontantReduction($montant_reduction) { $this->montant_reduction = $montant_reduction; }
    public function setDateDebut($date_debut) { $this->date_debut = $date_debut; }
    public function setDateFin($date_fin) { $this->date_fin = $date_fin; }
    public function setConditions($conditions) { $this->conditions = $conditions; }
    public function setIdSpons($id_spons) { $this->id_spons = $id_spons; }
}
