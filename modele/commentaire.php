<?php
class Commentaire
{
    private ?int $id_com;
    private ?string $contenu;
    private ?DateTime $date_creation;
    private ?int $id; // ID du sujet du forum lié

    public function __construct(?string $contenu, ?DateTime $date_creation = null, ?int $id )
    {
        $this->contenu = $contenu;
        $this->date_creation = $date_creation ?? new DateTime();
        $this->id = $id; // Clé étrangère : id du forum
    }
    

    public function show()
    {
        echo '
        <div style="
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            background-color: #ffffff;
        ">
            <p>' . nl2br(htmlspecialchars($this->contenu)) . '</p>
            <small style="color: gray;">Posté le : ' . ($this->date_creation ? $this->date_creation->format('d/m/Y H:i') : 'Inconnu') . '</small>
        </div>';
    }

    // Getters
    public function getIdCom(): ?int { return $this->id_com; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getDateCreation(): ?DateTime { return $this->date_creation; }
    public function getId(): ?int { return $this->id; }

    // Setters
    public function setIdCom(?int $id_com): void { $this->id_com = $id_com; }
    public function setContenu(?string $contenu): void { $this->contenu = $contenu; }
    public function setDateCreation(?DateTime $date_creation): void { $this->date_creation = $date_creation; }
    public function setId(?int $id): void { $this->id = $id; }
}
?>
