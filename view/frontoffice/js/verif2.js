document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".comment-form");
  
    forms.forEach(function (form) {
      const textarea = form.querySelector("textarea");
  
      const msgErreur = document.createElement("div");
      msgErreur.style.color = "red";
      msgErreur.style.marginTop = "5px";
      textarea.parentNode.insertBefore(msgErreur, textarea.nextSibling);
  
      form.addEventListener("submit", function (e) {
        const contenu = textarea.value.trim();
        msgErreur.textContent = "";
  
        if (contenu.length < 5) {
          msgErreur.textContent = "Le reponse doit contenir au moins 5 caractères.";
          textarea.style.border = "2px solid red";
          e.preventDefault();
        } else {
          textarea.style.border = ""; // Reset si valide
        }
      });
    });
  });
  