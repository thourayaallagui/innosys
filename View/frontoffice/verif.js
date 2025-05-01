document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("date_avis");
    const noteInput = document.querySelector('input[name="note"]');
    const commentaireInput = document.querySelector('textarea[name="commentaire"]');
    const form = document.querySelector(".form-avis");

    const noteError = document.getElementById("note_error");
    const commentaireError = document.getElementById("commentaire_error");
    const dateError = document.getElementById("date_error");

    form.addEventListener("submit", function (e) {
        let hasError = false;

        // Réinitialiser les messages d'erreur
        noteError.textContent = "";
        commentaireError.textContent = "";
        dateError.textContent = "";

        // Contrôle de la note
        const note = parseInt(noteInput.value);
        if (isNaN(note) || note < 0 || note > 5) {
            noteError.textContent = "La note doit être un nombre entre 0 et 5.";
            hasError = true;
        }

        // Contrôle du commentaire
        const commentaire = commentaireInput.value.trim();
        if (commentaire.length < 5) {
            commentaireError.textContent = "Le commentaire doit contenir au moins 5 caractères.";
            hasError = true;
        }

        // Contrôle de la date (doit être aujourd’hui)
        const inputDate = new Date(dateInput.value);
        const today = new Date();
        const inputDateStr = inputDate.toISOString().split('T')[0];
        const todayStr = today.toISOString().split('T')[0];

        if (inputDateStr !== todayStr) {
            dateError.textContent = "Veuillez sélectionner uniquement la date d'aujourd'hui.";
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Empêche l'envoi du formulaire
        }
    });
});
