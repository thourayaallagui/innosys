// Partie 1 : Validation du formulaire
function validerFormulaire() {
    var nomParticipant = document.getElementById("nom_de_participant").value;
    var dateReservation = document.getElementById("date_reservation").value;
    var nombrePlaces = document.getElementById("nombre_de_places").value;
    var statutReservation = document.getElementById("statut_reservation").value;
    var typePlace = document.getElementById("type_place").value;
    var montantTotal = document.getElementById("montant_total").value;

    // Vérification du nom du participant
    if (nomParticipant.length < 3) {
        alert("Le nom du participant doit contenir au moins 3 caractères.");
        return false;
    }

    // Vérification de la date de réservation
    if (dateReservation === "") {
        alert("Veuillez sélectionner une date de réservation.");
        return false;
    }

    // Vérification du nombre de places
    if (nombrePlaces <= 0 || isNaN(nombrePlaces)) {
        alert("Le nombre de places doit être un nombre positif.");
        return false;
    }

    // Vérification du statut de réservation (doit être non vide)
    if (statutReservation.trim() === "") {
        alert("Veuillez saisir un statut de réservation.");
        return false;
    }

    // Vérification du type de place
    if (typePlace.trim() === "") {
        alert("Veuillez préciser le type de place.");
        return false;
    }

    // Vérification du montant total
    if (montantTotal <= 0 || isNaN(montantTotal)) {
        alert("Le montant total doit être un nombre positif.");
        return false;
    }

    alert("Formulaire soumis avec succès !");
    return true;
}

// Partie 2 : Gestion des messages d'erreur en temps réel
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var isValid = true;

    function displayMessage(id, message, isError) {
        var element = document.getElementById(id + "_error");
        element.style.color = isError ? "red" : "green";
        element.innerText = message;
    }

    // Vérification et affichage des erreurs en temps réel
    var nomParticipant = document.getElementById("nom_de_participant").value;
    if (nomParticipant.length < 3) {
        displayMessage("nom_de_participant", "Le nom doit contenir au moins 3 caractères.", true);
        isValid = false;
    } else {
        displayMessage("nom_de_participant", "Correct", false);
    }

    var dateReservation = document.getElementById("date_reservation").value;
    if (dateReservation === "") {
        displayMessage("date_reservation", "Veuillez sélectionner une date.", true);
        isValid = false;
    } else {
        displayMessage("date_reservation", "Correct", false);
    }

    var nombrePlaces = document.getElementById("nombre_de_places").value;
    if (nombrePlaces <= 0 || isNaN(nombrePlaces)) {
        displayMessage("nombre_de_places", "Doit être un nombre positif.", true);
        isValid = false;
    } else {
        displayMessage("nombre_de_places", "Correct", false);
    }

    var statutReservation = document.getElementById("statut_reservation").value;
    if (statutReservation.trim() === "") {
        displayMessage("statut_reservation", "Statut requis.", true);
        isValid = false;
    } else {
        displayMessage("statut_reservation", "Correct", false);
    }

    var typePlace = document.getElementById("type_place").value;
    if (typePlace.trim() === "") {
        displayMessage("type_place", "Type de place requis.", true);
        isValid = false;
    } else {
        displayMessage("type_place", "Correct", false);
    }

    var montantTotal = document.getElementById("montant_total").value;
    if (montantTotal <= 0 || isNaN(montantTotal)) {
        displayMessage("montant_total", "Montant invalide.", true);
        isValid = false;
    } else {
        displayMessage("montant_total", "Correct", false);
    }

    if (isValid) {
        alert("Formulaire validé avec succès !");
    }
});

// Partie 3 : Validation en temps réel lors de la saisie
document.addEventListener('DOMContentLoaded', function() {
    var nomField = document.getElementById('nom_de_participant');
    var nombrePlacesField = document.getElementById('nombre_de_places');

    nomField.addEventListener('keyup', validateNom);
    nombrePlacesField.addEventListener('keyup', validateNombrePlaces);

    function validateNom() {
        var nom = nomField.value;
        var nomError = document.getElementById('nom_de_participant_error');

        if (nom.length >= 3) {
            nomError.style.color = "green";
            nomError.innerHTML = "Correct";
        } else {
            nomError.style.color = "red";
            nomError.innerHTML = "Le nom doit avoir au moins 3 caractères.";
        }
    }

    function validateNombrePlaces() {
        var nombre = nombrePlacesField.value;
        var nombreError = document.getElementById('nombre_de_places_error');

        if (nombre > 0 && !isNaN(nombre)) {
            nombreError.style.color = "green";
            nombreError.innerHTML = "Correct";
        } else {
            nombreError.style.color = "red";
            nombreError.innerHTML = "Doit être un nombre positif.";
        }
    }
});
