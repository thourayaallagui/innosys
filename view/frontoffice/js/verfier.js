document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formForum");
    const inputTitre = document.getElementById("forumTitre");
    const inputContenu = document.getElementById("forumContenu");
  
    const msgTitre = document.getElementById("msg-titre");
    const msgContenu = document.getElementById("msg-contenu");
  
    form.addEventListener("submit", function (e) {
      let isValid = true;
      const titre = inputTitre.value.trim();
      const contenu = inputContenu.value.trim();
  
      msgTitre.textContent = "";
      msgContenu.textContent = "";
  
      if (titre.length < 5) {
        msgTitre.textContent = "⚠️ Le titre doit contenir au moins 5 caractères.";
        isValid = false;
      }
  
      if (contenu.length < 10) {
        msgContenu.textContent = "⚠️ Le contenu doit contenir au moins 10 caractères.";
        isValid = false;
      }
  
      if (!isValid) {
        e.preventDefault();
      }
    });
  });
  