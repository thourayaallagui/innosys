document.getElementById('formForum').addEventListener('submit', function (e) {
  e.preventDefault();

  const auteur = document.getElementById('forumAuteur').value;
  const contenu = document.getElementById('forumContenu').value;

  if (auteur.trim() === '' || contenu.trim() === '') return;

  const date = new Date().toLocaleString(); // format lisible

  const card = document.createElement('div');
  card.classList.add('forum-card');

  card.innerHTML = `
    <p><strong class="auteur">${auteur}</strong> a écrit :</p>
    <p>${contenu}</p>
    <p style="color: gray; font-size: 0.9em; margin-top: 5px;">Posté le : ${date}</p>
    <div class="boutons">
      <button class="btn-modifier">Modifier</button>
      <button class="btn-supprimer">Supprimer</button>
    </div>
  `;

  const container = document.getElementById('forumsContainer');
  container.prepend(card); // pour afficher au-dessus

  document.getElementById('formForum').reset();
});
