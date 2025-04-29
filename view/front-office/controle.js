document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("sponsorForm");
  
    form.addEventListener("submit", function (e) {
      let valid = true;
  
      // Clear all previous errors
      document.querySelectorAll(".text-danger").forEach(span => span.textContent = "");
  
      // Nom validation
      const nom = document.getElementById("nom").value.trim();
      if (nom === "") {
        document.getElementById("error-nom").textContent = "Le nom est requis.";
        valid = false;
      }
  
      // Montant validation
      const mont = document.getElementById("mont").value.trim();
      if (mont === "") {
        document.getElementById("error-mont").textContent = "Le montant est requis.";
        valid = false;
      } else if (isNaN(mont) || Number(mont) <= 0) {
        document.getElementById("error-mont").textContent = "Le montant doit être un nombre positif.";
        valid = false;
      }
  
      // Type validation
      const type = document.getElementById("type").value;
      if (type === "") {
        document.getElementById("error-type").textContent = "Veuillez sélectionner un type.";
        valid = false;
      }
  
      // Date validation
      const dateA = document.getElementById("dateA").value;
      if (dateA === "") {
        document.getElementById("error-dateA").textContent = "La date est requise.";
        valid = false;
      }
  
      // Engagement validation
      const engag = document.getElementById("engag").value.trim();
      if (engag.length < 10) {
        document.getElementById("error-engag").textContent = "L'engagement doit contenir au moins 10 caractères.";
        valid = false;
      }
  
      if (!valid) {
        e.preventDefault(); // Prevent form submission if validation fails
      }
    });
  });
  