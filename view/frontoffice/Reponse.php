<?php class Reponse {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function addReponse($contenu, $date_creation) {
        $sql = "INSERT INTO reponse (contenu, date_creation) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$contenu, $date_creation]);
    }

    public function getReponse($id) {
        $sql = "SELECT * FROM reponse WHERE id_reponse = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} ?>