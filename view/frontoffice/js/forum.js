document.getElementById("formForum").addEventListener("submit", function(e) {
    e.preventDefault();
  
    const auteur = document.getElementById("forumAuteur").value;
    const contenu = document.getElementById("forumContenu").value;
    const container = document.getElementById("forumsContainer");
  
    const date = new Date();
    const dateString = date.toLocaleDateString("fr-FR") + " - " + date.toLocaleTimeString("fr-FR", { hour: '2-digit', minute: '2-digit' });
  
    const card = document.createElement("div");
    card.classList.add("forum-card");
  
    card.innerHTML = `
      <strong class="auteur">${auteur}</strong> a écrit :
      <p>${contenu}</p>
      <small>Créé le : <span class="date-creation">${dateString}</span></small>
      <div class="boutons">
        <button class="btn-modifier">Modifier</button>
        <button class="btn-supprimer">Supprimer</button>
      </div>
    `;
  
    container.prepend(card); // affiche en haut
    this.reset(); // reset form
  });
  