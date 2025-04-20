<?php
class Blog
{

    private ?int $id_blog = null;
    private ?string $titre;
    private ?string $contenu;
    private ?int $nb_vues;
    private ?int $nb_likes;
    private ?DateTime $date_publication;
    private ?string $categorie;

    // Constructeur
    public function __construct(?string $titre, ?string $contenu, ?int $nb_vues, ?int $nb_likes, ?DateTime $date_publication, ?string $categorie)
    {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->nb_vues = $nb_vues;
        $this->nb_likes = $nb_likes;
        $this->date_publication = $date_publication;
        $this->categorie = $categorie;
    }

    public function show() {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>Titre</td>
                <td>Contenu</td>
                <td>Vues</td>
                <td>Likes</td>
                <td>Date de publication</td>
                <td>Catégorie</td>
            </tr>
            <tr>
                <td>'. htmlspecialchars($this->titre) .'</td>
                <td>'. nl2br(htmlspecialchars($this->contenu)) .'</td>
                <td>'. $this->nb_vues .'</td>
                <td>'. $this->nb_likes .'</td>
                <td>'. $this->date_publication->format('Y-m-d H:i:s') .'</td>
                <td>'. htmlspecialchars($this->categorie) .'</td>
            </tr>
        </table>';
    }

    // Getters
    public function getIdBlog(): ?int { return $this->id_blog; }
    public function getTitre(): ?string { return $this->titre; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getNbVues(): ?int { return $this->nb_vues; }
    public function getNbLikes(): ?int { return $this->nb_likes; }
    public function getDatePublication(): ?DateTime { return $this->date_publication; }
    public function getCategorie(): ?string { return $this->categorie; }

    // Setters
    public function setIdBlog(?int $id_blog): void { $this->id_blog = $id_blog; }
    public function setTitre(?string $titre): void { $this->titre = $titre; }
    public function setContenu(?string $contenu): void { $this->contenu = $contenu; }
    public function setNbVues(?int $nb_vues): void { $this->nb_vues = $nb_vues; }
    public function setNbLikes(?int $nb_likes): void { $this->nb_likes = $nb_likes; }
    public function setDatePublication(?DateTime $date_publication): void { $this->date_publication = $date_publication; }
    public function setCategorie(?string $categorie): void { $this->categorie = $categorie; }
}
?>
