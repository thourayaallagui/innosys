<?php
require_once('C:/xampp/htdocs/gevent/config.php');
include 'C:/xampp/htdocs/gevent/model/reservation.php';

class ReservationC
{
    // Create Reservation
    public function create($res)
    {
        $sql = "INSERT INTO `reservation`(`nomClient`, `emailClient`, `telClient`, `dateReservation`, `event_id`)
                VALUES (:nomClient, :emailClient, :telClient, :dateReservation, :event_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomClient' => $res->getNomClient(),
                'emailClient' => $res->getEmailClient(),
                'telClient' => $res->getTelClient(),
                'dateReservation' => $res->getDateReservation(),
                'event_id' => $res->getEventId(), // Include event_id
            ]);
            echo "<script>alert('Reservation enregister !');</script>";
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Read all reservations
    public function read()
    {
        $sql = "SELECT * FROM reservation";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    // Update Reservation
    public function update($res, $id)
    {
        $sql = "UPDATE `reservation` SET `nomClient`=:nomClient, `emailClient`=:emailClient,
                `telClient`=:telClient, `dateReservation`=:dateReservation, `event_id`=:event_id WHERE `id`=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomClient' => $res->getNomClient(),
                'emailClient' => $res->getEmailClient(),
                'telClient' => $res->getTelClient(),
                'dateReservation' => $res->getDateReservation(),
                'event_id' => $res->getEventId(), // Update event_id
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    // Delete Reservation
    public function delete()
    {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM `reservation` WHERE `id` = '$id'";
            $db = config::getConnexion();
            try {
                $db->prepare($sql)->execute();
                header("Location:reservations.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }

    // Find one Reservation by ID
    public function findone($id)
    {
        $sql = "SELECT * FROM reservation WHERE id = '$id'";
        $db = config::getConnexion();
        try {
            $result = $db->query($sql);
            return $result->fetch();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
