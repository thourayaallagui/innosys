<?php
class Avis
{
    private ?int $id_avis = null;
    private ?int $note;
    private ?string $commentaire;
    private ?DateTime $date_avis;
    private ?int $id_blog;

    // Constructeur
    public function __construct(?int $note, ?string $commentaire, ?DateTime $date_avis, ?int $id_blog)
    {
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->date_avis = $date_avis;
        $this->id_blog = $id_blog;

    }

    public function show() {
        echo '<table border=1 width="100%">
            <tr align="center">
                <td>Note</td>
                <td>Commentaire</td>
                <td>Date de l\'avis</td>
            </tr>
            <tr>
                <td>'. $this->note .'</td>
                <td>'. nl2br(htmlspecialchars($this->commentaire)) .'</td>
                <td>'. $this->date_avis->format('Y-m-d H:i:s') .'</td>
            </tr>
        </table>';
    }

    // Getters
    public function getIdAvis(): ?int { return $this->id_avis; }
    public function getNote(): ?int { return $this->note; }
    public function getCommentaire(): ?string { return $this->commentaire; }
    public function getDateAvis(): ?DateTime { return $this->date_avis; }
    public function getIdBlog(): ?int { return $this->id_blog; }


    // Setters
    public function setIdAvis(?int $id_avis): void { $this->id_avis = $id_avis; }
    public function setNote(?int $note): void { $this->note = $note; }
    public function setCommentaire(?string $commentaire): void { $this->commentaire = $commentaire; }
    public function setDateAvis(?DateTime $date_avis): void { $this->date_avis = $date_avis; }
    public function setIdBlog(?int $id_blog): void { $this->id_blog = $id_blog; }

}
?>
