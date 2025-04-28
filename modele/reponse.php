<?php
class Reponse
{
    private ?int $id_rep;
    private ?string $contenu;
    private ?DateTime $date_creation;
    private ?int $id_com; // id du commentaire auquel cette réponse appartient

    // Constructeur
    public function __construct(?string $contenu,  ?DateTime $date_creation = null,?int $id_com)
    {
    
        $this->contenu = $contenu;
       
        $this->date_creation = $date_creation ?? new DateTime();
        $this->id_com = $id_com;
    }

    // Méthode d'affichage
    public function show()
    {
        echo '
        <div style="
            border: 2px solid #007BFF;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f0f8ff;
        ">
            <p>' . nl2br(htmlspecialchars($this->contenu)) . '</p>
            <small style="color: gray;">Réponse postée le : ' . 
                ($this->date_creation ? $this->date_creation->format('d/m/Y H:i') : 'Inconnue') . 
            '</small>
            <div style="margin-top: 10px;">
                <a href="modifier_reponse.php?id_rep=' . $this->id_rep . '" style="
                    padding: 5px 10px;
                    background-color: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-right: 10px;
                ">Modifier</a>
                <a href="supprimer_reponse.php?id_rep=' . $this->id_rep . '" style="
                    padding: 5px 10px;
                    background-color: #dc3545;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                ">Supprimer</a>
            </div>
        </div>';
    }

    // Getters
    public function getIdRep(): ?int { return $this->id_rep; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getDateCreation(): ?DateTime { return $this->date_creation; }
    public function getIdCom(): ?int { return $this->id_com; }

    // Setters
    public function setIdRep(?int $id_rep): void { $this->id_rep = $id_rep; }
    public function setContenu(?string $contenu): void { $this->contenu = $contenu; }
    public function setDateCreation(?DateTime $date_creation): void { $this->date_creation = $date_creation; }
    public function setIdCom(?int $id_com): void { $this->id_com = $id_com; }
}
?>
