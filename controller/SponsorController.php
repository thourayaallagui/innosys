<?php

require_once __DIR__ . '/../model/Sponsor.php';
require_once __DIR__ . '/../connexion.php';

class SponsorController {
    public function createSponsor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
            $sponsor = new Sponsor(
                $_POST['nom_entreprise'],
                $_POST['montant_sponsor'],
                $_POST['type_sponsor'],
                $_POST['date_acceptation'],
                $_POST['engagement']
            );
            $this->create($sponsor);
            header('Location: back-sponsor.php');
            exit;
        }
    }

    public function updateSponsor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
            $id = $_POST['id_sponsor'];
            $sponsor = new Sponsor(
                $_POST['nom_entreprise'],
                $_POST['montant_sponsor'],
                $_POST['type_sponsor'],
                $_POST['date_acceptation'],
                $_POST['engagement']
            );
            $this->update($id, $sponsor);
            header('Location: back-sponsor.php');
            exit;
        }
    }

    public function deleteSponsor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
            $id = $_POST['id_sponsor'];
            $this->delete($id);
            header('Location: back-sponsor.php');
            exit;
        }
    }

    public function create(Sponsor $sponsor) {
        $db = config::getConnexion();
        $stmt = $db->prepare("INSERT INTO sponsor (nom_entreprise, montant_sponsor, type_sponsor, date_acceptation, engagement) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $sponsor->getNomEntreprise(),
            $sponsor->getMontantSponsor(),
            $sponsor->getTypeSponsor(),
            $sponsor->getDateAcceptation(),
            $sponsor->getEngagement()
        ]);
    }

    public function update($id, Sponsor $sponsor) {
        $db = config::getConnexion();
        $stmt = $db->prepare("UPDATE sponsor SET nom_entreprise=?, montant_sponsor=?, type_sponsor=?, date_acceptation=?, engagement=? WHERE id_sponsor=?");
        $stmt->execute([
            $sponsor->getNomEntreprise(),
            $sponsor->getMontantSponsor(),
            $sponsor->getTypeSponsor(),
            $sponsor->getDateAcceptation(),
            $sponsor->getEngagement(),
            $id
        ]);
    }

    public function delete($id) {
        $db = config::getConnexion();
        $stmt = $db->prepare("DELETE FROM sponsor WHERE id_sponsor=?");
        $stmt->execute([$id]);
    }

    public function getOne($id) {
        $db = config::getConnexion();
        $stmt = $db->prepare("SELECT * FROM sponsor WHERE id_sponsor=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function index() {
        $db = config::getConnexion();
        return $db->query("SELECT * FROM sponsor")->fetchAll();
    }
}
