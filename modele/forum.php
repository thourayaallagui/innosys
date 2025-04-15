<?php
class Forum
{
    private ?int $id;
    private ?string $titre;
    private ?string $contenu;
    private ?DateTime $date_creation;

    // Constructeur
    public function __construct(?string $titre, ?string $contenu, ?DateTime $date_creation = null, ?int $id = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->date_creation = $date_creation ?? new DateTime();
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
            background-color: #f9f9f9;
        ">
            <h3 style="margin: 0; color: #007BFF;">' . htmlspecialchars($this->titre) . '</h3>
            <p>' . nl2br(htmlspecialchars($this->contenu)) . '</p>
            <small style="color: gray;">Créé le : ' . ($this->date_creation ? $this->date_creation->format('d/m/Y H:i') : 'Inconnu') . '</small>
            <div style="margin-top: 10px;">
                <a href="modifier.php?id=' . $this->id . '" style="
                    padding: 5px 10px;
                    background-color: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-right: 10px;
                ">Modifier</a>
                <a href="supprimer.php?id=' . $this->id . '" style="
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
    public function getId(): ?int { return $this->id; }
    public function getTitre(): ?string { return $this->titre; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getDateCreation(): ?DateTime { return $this->date_creation; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setTitre(?string $titre): void { $this->titre = $titre; }
    public function setContenu(?string $contenu): void { $this->contenu = $contenu; }
    public function setDateCreation(?DateTime $date_creation): void { $this->date_creation = $date_creation; }
}
?>
