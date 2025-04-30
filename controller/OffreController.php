<?php
require_once __DIR__ . '/../model/offre.php';
require_once __DIR__ . '/../connexion.php';

class OffreController {
    public function createOffre() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
            // Validation des données
            if (empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['montant_reduction']) || empty($_POST['date_debut']) || empty($_POST['date_fin']) || empty($_POST['conditions']) || empty($_POST['id_spons'])) {
                $_SESSION['error'] = "Tous les champs doivent être remplis.";
                header('Location: back-offre.php');
                exit;
            }
    
            $offre = new Offre(
                $_POST['titre'],
                $_POST['description'],
                $_POST['montant_reduction'],
                $_POST['date_debut'],
                $_POST['date_fin'],
                $_POST['conditions'],
                $_POST['id_spons']
            );
    
            $this->create($offre);
            $_SESSION['success'] = "L'offre a été créée avec succès.";
            header('Location: back-offre.php');
            exit;
        }
    }
    
    public function updateOffre() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            // Validation des données
            if (empty($_POST['titre']) || empty($_POST['description']) || empty($_POST['montant_reduction']) || empty($_POST['date_debut']) || empty($_POST['date_fin']) || empty($_POST['conditions']) || empty($_POST['id_spons'])) {
                $_SESSION['error'] = "Tous les champs doivent être remplis.";
                header('Location: back-offre.php');
                exit;
            }
    
            $id = $_POST['id_offre'];
            $offre = new Offre(
                $_POST['titre'],
                $_POST['description'],
                $_POST['montant_reduction'],
                $_POST['date_debut'],
                $_POST['date_fin'],
                $_POST['conditions'],
                $_POST['id_spons']
            );
    
            $this->update($id, $offre);
            $_SESSION['success'] = "L'offre a été mise à jour avec succès.";
            header('Location: back-offre.php');
            exit;
        }
    }
    
    public function deleteOffre() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $id = $_POST['id_offre'];
            $this->delete($id);
            $_SESSION['success'] = "L'offre a été supprimée avec succès.";
            header('Location: back-offre.php');
            exit;
        }
    }
    

    public function create(Offre $offre) {
        $db = config::getConnexion();
        $stmt = $db->prepare("INSERT INTO offre (titre, description, montant_reduction, date_debut, date_fin, conditions, id_spons) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $offre->getTitre(),
            $offre->getDescription(),
            $offre->getMontantReduction(),
            $offre->getDateDebut(),
            $offre->getDateFin(),
            $offre->getConditions(),
            $offre->getIdSpons()
        ]);
    }

    public function update($id, Offre $offre) {
        $db = config::getConnexion();
        $stmt = $db->prepare("UPDATE offre SET titre=?, description=?, montant_reduction=?, date_debut=?, date_fin=?, conditions=?, id_spons=? WHERE id_offre=?");
        $stmt->execute([
            $offre->getTitre(),
            $offre->getDescription(),
            $offre->getMontantReduction(),
            $offre->getDateDebut(),
            $offre->getDateFin(),
            $offre->getConditions(),
            $offre->getIdSpons(),
            $id
        ]);
    }

    public function delete($id) {
        $db = config::getConnexion();
        $stmt = $db->prepare("DELETE FROM offre WHERE id_offre=?");
        $stmt->execute([$id]);
    }

    public function getOne($id) {
        $db = config::getConnexion();
        $stmt = $db->prepare("SELECT * FROM offre WHERE id_offre=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    

    public function index() {
        $db = config::getConnexion();
        return $db->query("SELECT * FROM offre")->fetchAll();
    }
}
