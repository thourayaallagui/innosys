
<?php
if (!class_exists('Reponse')) {
    class Reponse
    {
        private ?int $id_reponse;
        private ?string $contenu;
        private ?DateTime $date_creation;
        private ?int $id_reclamation;

        public function __construct(?string $contenu, ?DateTime $date_creation, ?int $id_reclamation = null)
        {
            $this->contenu = $contenu;
            $this->date_creation = $date_creation;
            $this->id_reclamation = $id_reclamation;
        }

        public function show()
        {
            echo '<table border=1 width="100%">
                <tr align="center">
                    <td>ID Réponse</td>
                    <td>Contenu</td>
                    <td>Date de création</td>
                    <td>ID Réclamation</td>
                </tr>
                <tr>
                    <td>' . $this->id_reponse . '</td>
                    <td>' . htmlspecialchars($this->contenu) . '</td>
                    <td>' . $this->date_creation->format('Y-m-d') . '</td>
                    <td>' . $this->id_reclamation . '</td>
                </tr>
            </table>';
        }

        // Getters
        public function getIdReponse(): ?int { return $this->id_reponse; }
        public function getContenu(): ?string { return $this->contenu; }
        public function getDateCreation(): ?DateTime { return $this->date_creation; }
        public function getIdReclamation(): ?int { return $this->id_reclamation; }

        // Setters
        public function setIdReponse(?int $id_reponse): void { $this->id_reponse = $id_reponse; }
        public function setContenu(?string $contenu): void { $this->contenu = $contenu; }
        public function setDateCreation(?DateTime $date_creation): void { $this->date_creation = $date_creation; }
        public function setIdReclamation(?int $id_reclamation): void { $this->id_reclamation = $id_reclamation; }
    }
}

public function getReclamationsWithReponse() {
    $sql = "SELECT r.*, p.contenu as reponse_contenu 
            FROM reclam r 
            LEFT JOIN reponse p ON r.id_reponse = p.id_reponse";
    $db = Config::getConnexion();
    try {
        $list = $db->query($sql);
        return $list->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function updateReponseId($id_reclamation, $id_reponse) {
    $sql = "UPDATE reclam SET id_reponse = ? WHERE id_reclamation = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id_reponse, $id_reclamation]);
}
?>