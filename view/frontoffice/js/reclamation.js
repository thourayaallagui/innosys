// Partie 1 : Validation du formulaire lors de la soumission
document.getElementById("reclamationForm").addEventListener("submit", function(event) {
    let isValid = true;
    var nom_de_participant = document.getElementById("nom_de_participant").value;
    const dateCreation = document.getElementById("date_creation").value;
    const objet = document.getElementById("objet").value.trim();
    const status = document.getElementById("status").value;

    if (!dateCreation) {
        afficherMessage("date_creation", "Veuillez entrer une date.", true);
        isValid = false;
    } else {
        afficherMessage("date_creation", "Correct", false);
    }

    if (objet.length < 5) {
        afficherMessage("objet", "L'objet doit contenir au moins 5 caractères.", true);
        isValid = false;
    } else {
        afficherMessage("objet", "Correct", false);
    }

    if (status === "") {
        afficherMessage("status", "Veuillez choisir un statut.", true);
        isValid = false;
    } else {
        afficherMessage("status", "Correct", false);
    }

    if (!isValid) {
        event.preventDefault(); // Empêche l'envoi du formulaire si non valide
    } else {
        alert("Réclamation soumise avec succès !");
    }
});

// Partie 2 : Fonction d’affichage des messages
function afficherMessage(id, message, isError) {
    const el = document.getElementById(id + "_error");
    el.style.color = isError ? "red" : "green";
    el.innerText = message;
}

// Partie 3 : Validation en temps réel
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById("objet").addEventListener("input", function () {
        const val = this.value.trim();
        if (val.length >= 5) {
            afficherMessage("objet", "Correct", false);
        } else {
            afficherMessage("objet", "L'objet doit contenir au moins 5 caractères.", true);
        }
    });

    document.getElementById("date_creation").addEventListener("change", function () {
        if (this.value) {
            afficherMessage("date_creation", "Correct", false);
        } else {
            afficherMessage("date_creation", "Veuillez entrer une date.", true);
        }
    });

    document.getElementById("status").addEventListener("change", function () {
        if (this.value !== "") {
            afficherMessage("status", "Correct", false);
        } else {
            afficherMessage("status", "Veuillez choisir un statut.", true);
        }
    });
});




// Validation du formulaire de modification
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionnez tous les formulaires de modification
    const editForms = document.querySelectorAll('.reclam-form');
    
    editForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const objet = this.querySelector('input[name="objet"]').value.trim();
            const dateCreation = this.querySelector('input[name="date_creation"]').value;
            const statut = this.querySelector('select[name="statut"]').value;
            const nomUtilisateur = this.querySelector('input[name="nom_utilisateur"]').value.trim();

            if (!dateCreation) {
                alert("Veuillez entrer une date.");
                isValid = false;
            }

            if (objet.length < 5) {
                alert("L'objet doit contenir au moins 5 caractères.");
                isValid = false;
            }

            if (statut === "") {
                alert("Veuillez choisir un statut.");
                isValid = false;
            }

            if (nomUtilisateur === "") {
                alert("Veuillez entrer un nom d'utilisateur.");
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
});




?>
