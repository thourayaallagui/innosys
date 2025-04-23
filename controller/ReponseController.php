<?php
require __DIR__.'/../config.php';
require_once __DIR__. '/../Model/Reponse.php';class ReponseController {
    private $model;

    public function __construct() {
        $this->model = new Reponse();
    }

    public function addReponseToReclamation($id_reclamation, $contenu) {
        $date = date('Y-m-d');
        $id_reponse = $this->model->addReponse($contenu, $date);
        
        if ($id_reponse) {
            // Mettre à jour la réclamation avec l'ID de la réponse
            $reclamModel = new Reclamation();
            return $reclamModel->updateReponseId($id_reclamation, $id_reponse);
        }
        return false;
    }
} ?>