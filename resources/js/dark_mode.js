
document.addEventListener('DOMContentLoaded', () => {
    const themeSwitch = document.getElementById('themeSwitch');
    const root = document.documentElement;
  
    // Verifica si el switch existe antes de manipularlo
    if (themeSwitch) {
      // Al cargar la página, aplica el tema almacenado
      const savedTheme = localStorage.getItem('theme') || 'light';
      root.setAttribute('data-bs-theme', savedTheme);
      themeSwitch.checked = savedTheme === 'dark';
  
      // Cambia el tema al activar/desactivar el interruptor
      themeSwitch.addEventListener('change', () => {
        const newTheme = themeSwitch.checked ? 'dark' : 'light';
        root.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
      });
    }
  });
