function showToast(messageTitle, messageText = '', type = 'success') {
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;

  // Conteneur principal avec style
  toast.style.position = 'fixed';
  toast.style.bottom = '20px';
  toast.style.right = '20px';
  toast.style.backgroundColor = '#fff';
  toast.style.color = '#000';
  toast.style.padding = '15px 20px';
  toast.style.borderRadius = '12px';
  toast.style.zIndex = '9999';
  toast.style.fontFamily = 'Arial, sans-serif';
  toast.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.2)';
  toast.style.borderLeft = '6px solid #00c853';
  toast.style.display = 'flex';
  toast.style.alignItems = 'center';
  toast.style.minWidth = '300px';
  toast.style.gap = '12px';
  toast.style.opacity = '0';
  toast.style.transition = 'opacity 0.4s ease';

  // Icône
  const icon = document.createElement('div');
  icon.innerHTML = '✅'; // ou une icône SVG
  icon.style.fontSize = '20px';

  // Texte
  const textContainer = document.createElement('div');
  textContainer.innerHTML = `<strong>${messageTitle}</strong><br><span style="font-size: 14px; color: #555;">${messageText}</span>`;

  // Bouton de fermeture
  const closeBtn = document.createElement('div');
  closeBtn.innerHTML = '&times;';
  closeBtn.style.marginLeft = 'auto';
  closeBtn.style.cursor = 'pointer';
  closeBtn.style.fontSize = '18px';
  closeBtn.style.color = '#999';
  closeBtn.onclick = () => toast.remove();

  toast.appendChild(icon);
  toast.appendChild(textContainer);
  toast.appendChild(closeBtn);

  document.body.appendChild(toast);

  setTimeout(() => toast.style.opacity = '1', 100); // fade-in

  const sound = document.getElementById('notification-sound');
  if (sound) {
    sound.currentTime = 0;
    sound.play().catch(e => console.log("Audio non autorisé sans interaction", e));
  }

  // Auto-fermeture après 4s
  setTimeout(() => {
    toast.style.opacity = '0'; // fade-out
    setTimeout(() => toast.remove(), 1000);
  }, 4000);
}
