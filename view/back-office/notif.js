function showToast(messageTitle, messageText = '', type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
  
    // Palette de couleurs par type
    const colorMap = {
      success: '#00c853',
      error: '#d50000',
      warning: '#ffab00',
      info: '#2962ff'
    };
  
    const iconMap = {
      success: '✅',
      error: '❌',
      warning: '⚠️',
      info: 'ℹ️'
    };
  
    // Conteneur principal
    toast.style.position = 'fixed';
    toast.style.bottom = '30px';
    toast.style.right = '30px';
    toast.style.backgroundColor = '#ffffff';
    toast.style.color = '#333';
    toast.style.padding = '16px 22px';
    toast.style.borderRadius = '10px';
    toast.style.zIndex = '9999';
    toast.style.fontFamily = 'Segoe UI, sans-serif';
    toast.style.boxShadow = '0 8px 20px rgba(0, 0, 0, 0.15)';
    toast.style.borderLeft = `6px solid ${colorMap[type] || '#00c853'}`;
    toast.style.display = 'flex';
    toast.style.alignItems = 'flex-start';
    toast.style.minWidth = '320px';
    toast.style.gap = '14px';
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.5s ease';
  
    // Icône
    const icon = document.createElement('div');
    icon.innerHTML = iconMap[type] || '✅';
    icon.style.fontSize = '22px';
    icon.style.marginTop = '2px';
  
    // Texte
    const textContainer = document.createElement('div');
    textContainer.innerHTML = `
      <strong style="font-size: 16px;">${messageTitle}</strong><br>
      <span style="font-size: 14px; color: #555;">${messageText}</span>
    `;
  
    // Bouton de fermeture
    const closeBtn = document.createElement('div');
    closeBtn.innerHTML = '&times;';
    closeBtn.style.marginLeft = 'auto';
    closeBtn.style.cursor = 'pointer';
    closeBtn.style.fontSize = '20px';
    closeBtn.style.color = '#aaa';
    closeBtn.style.marginTop = '-5px';
    closeBtn.onclick = () => toast.remove();
  
    toast.appendChild(icon);
    toast.appendChild(textContainer);
    toast.appendChild(closeBtn);
  
    document.body.appendChild(toast);
  
    // Fade-in
    setTimeout(() => toast.style.opacity = '1', 100);
  
    // Son
    const sound = document.getElementById('notification-sound');
    if (sound) {
      sound.currentTime = 0;
      sound.play().catch(e => console.log("Audio non autorisé sans interaction", e));
    }
  
    // Auto-fermeture
    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 800);
    }, 4000);
  }
  