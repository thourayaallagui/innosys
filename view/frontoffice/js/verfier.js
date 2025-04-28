document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("formForum");
  const inputTitre = document.getElementById("forumTitre");
  const inputContenu = document.getElementById("forumContenu");

  const msgTitre = document.getElementById("msg-titre");
  const msgContenu = document.getElementById("msg-contenu");

  // Liste des mots interdits
  const forbiddenWords = ["fuck", "shit", "bitch", "asshole", "merde", "connard", "pute"];

  form.addEventListener("submit", function (e) {
    let isValid = true;
    const titre = inputTitre.value.trim();
    const contenu = inputContenu.value.trim();

    // Réinitialisation des messages et des styles
    msgTitre.textContent = "";
    msgContenu.textContent = "";
    inputTitre.style.borderColor = "";
    inputContenu.style.borderColor = "";

    // Vérification de la longueur du titre
    if (titre.length < 5) {
      msgTitre.textContent = "Le titre doit contenir au moins 5 caractères.";
      inputTitre.style.borderColor = "red";
      isValid = false;
    }

    // Vérification de la majuscule au début du titre
    if (titre.charAt(0) !== titre.charAt(0).toUpperCase()) {
      msgTitre.textContent += "\nLa première lettre du titre doit être une majuscule.";
      inputTitre.style.borderColor = "red";
      isValid = false;
    }

    // Vérification de la longueur du contenu
    if (contenu.length < 10) {
      msgContenu.textContent = "Le contenu doit contenir au moins 10 caractères.";
      inputContenu.style.borderColor = "red";
      isValid = false;
    }

    // Vérification des mots interdits
    const lowerCaseContenu = contenu.toLowerCase();
    let foundForbiddenWord = false;

    console.log("Contenu à vérifier : ", lowerCaseContenu);  // Log de débogage

    for (let word of forbiddenWords) {
      const regex = new RegExp(`\\b${word}\\b`, 'i');  // Recherche du mot entier, insensible à la casse
      if (regex.test(lowerCaseContenu)) {
        console.log(`Mot interdit trouvé : ${word}`);  // Log de débogage
        foundForbiddenWord = true;
        break;
      }
    }

    // Si un mot interdit est trouvé, on affiche l'erreur
    if (foundForbiddenWord) {
      msgContenu.textContent = "Ce contenu contient des mots inappropriés et ne peut pas être partagé.";
      inputContenu.style.borderColor = "red";
      isValid = false;
    }

    // Si une erreur est présente, on empêche la soumission du formulaire
    if (!isValid) {
      e.preventDefault();  // Empêche l'envoi du formulaire
      console.log("Formulaire bloqué : erreur de validation");  // Log de débogage
    } else {
      console.log("Formulaire validé et envoyé");  // Log de débogage
    }
  });
});
