function genererSuggestion() {
    const texteSujet = prompt("Entre le sujet ou commentaire pour générer une réponse IA :");

    if (!texteSujet) {
        alert("Aucun texte saisi.");
        return;
    }

    fetch('generateSuggestion.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'texte=' + encodeURIComponent(texteSujet)
    })
    .then(response => response.json())
    .then(data => {
        if (data.suggestion) {
            document.getElementById('reponseContenu').value = data.suggestion;
        } else {
            alert('Erreur : ' + (data.error || 'Suggestion non générée.'));
        }
    })
    .catch(error => {
        alert('Erreur lors de la communication avec le serveur.');
        console.error(error);
    });
}