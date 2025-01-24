// Referencias a los elementos
const sidebar = document.getElementById('customSidebar');
const openBtn = document.getElementById('sidebarToggle');
const closeBtn = document.getElementById('closeSidebar');


// Validación para evitar errores
if (sidebar && openBtn && closeBtn) {
    // Abrir Sidebar
    openBtn.addEventListener('click', () => {
        sidebar.style.left = '0';
    });

    // Cerrar Sidebar
    closeBtn.addEventListener('click', () => {
        sidebar.style.left = '-100%';
    });

    // Cerrar Sidebar al hacer clic fuera
    window.addEventListener('click', (e) => {
        if (e.target !== sidebar && !sidebar.contains(e.target) && e.target !== openBtn) {
            sidebar.style.left = '-100%';
        }
    });
}