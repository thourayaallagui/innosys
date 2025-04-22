<?php
class Sponsor
{
    private ?int $id; // Primary key, auto-increment
    private ?string $nom; // Name of the sponsor
    private ?string $mont; // Amount sponsored (varchar(50))
    private ?string $type; // Type of the sponsor (varchar(50))
    private ?string $dateA; // Date of sponsorship (date)
    private ?string $engag; // Engagement description (varchar(50))

    // Constructor
    public function __construct($id = null, $nom, $mont, $type, $dateA, $engag)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->mont = $mont;
        $this->type = $type;
        $this->dateA = $dateA;
        $this->engag = $engag;
    }

    // Getter and Setter for id (Primary key, auto-increment)
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    // Getter and Setter for nom
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    // Getter and Setter for mont
    public function getMont(): ?string
    {
        return $this->mont;
    }

    public function setMont(string $mont): self
    {
        $this->mont = $mont;
        return $this;
    }

    // Getter and Setter for type
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    // Getter and Setter for dateA
    public function getDateA(): ?string
    {
        return $this->dateA;
    }

    public function setDateA(string $dateA): self
    {
        $this->dateA = $dateA;
        return $this;
    }

    // Getter and Setter for engag
    public function getEngag(): ?string
    {
        return $this->engag;
    }

    public function setEngag(string $engag): self
    {
        $this->engag = $engag;
        return $this;
    }
}
?>
