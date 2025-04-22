<?php
  class Reclamation
    {
        private ?int $id_reclamation;
        private ?DateTime $date_creation;
        private ?string $objet;
        private ?string $statut;
        private ?string $nom_utilisateur;

        public function __construct(?DateTime $date_creation = null, ?string $objet = null, ?string $statut = null, ?string $nom_utilisateur = null)
        {
            $this->date_creation = $date_creation;
            $this->objet = $objet;
            $this->statut = $statut;
            $this->nom_utilisateur = $nom_utilisateur;
        }

        public function show()
        {
            echo '<table border=1 width="100%">
                <tr align="center">
                    <td>Date de création</td>
                    <td>Objet</td>
                    <td>Statut</td>
                    <td>Nom utilisateur</td>
                </tr>
                <tr>
                    <td>' . (is_object($this->date_creation) ? $this->date_creation->format('Y-m-d') : '') . '</td>
                    <td>' . htmlspecialchars($this->objet ?? '') . '</td>
                    <td>' . htmlspecialchars($this->statut ?? '') . '</td>
                    <td>' . htmlspecialchars($this->nom_utilisateur ?? '') . '</td>
                </tr>
            </table>';
        }

        // Getters
        public function getIdReclamation(): ?int { return $this->id_reclamation; }
        public function getDateCreation(): ?DateTime { return $this->date_creation; }
        public function getObjet(): ?string { return $this->objet; }
        public function getStatut(): ?string { return $this->statut; }
        public function getNomUtilisateur(): ?string { return $this->nom_utilisateur; }

        // Setters
        public function setIdReclamation(?int $id_reclamation): void { $this->id_reclamation = $id_reclamation; }
        public function setDateCreation(?DateTime $date_creation): void { $this->date_creation = $date_creation; }
        public function setObjet(?string $objet): void { $this->objet = $objet; }
        public function setStatut(?string $statut): void { $this->statut = $statut; }
        public function setNomUtilisateur(?string $nom_utilisateur): void { $this->nom_utilisateur = $nom_utilisateur; }
    }

?>
