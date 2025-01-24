

// Abrir cualquier modal dinámicamente
Livewire.on('show-modal', ({ modalId }) => {
    const modalElement = document.getElementById(modalId); // Asegúrate de que modalElement esté definido
    if (!modalElement) {
        console.error(`Modal with id "${modalId}" not found.`);
        return; // Sal del método si no se encuentra el modal
    }

    const modal = new bootstrap.Modal(modalElement);

    // Antes de mostrar, remueve 'aria-hidden' y mueve el foco al primer elemento interactivo
    modalElement.removeAttribute('aria-hidden');
    modalElement.querySelector('input, button, [tabindex="0"]')?.focus();

    modal.show();
});

// Cerrar cualquier modal dinámicamente
Livewire.on('hide-modal', ({ modalId }) => {
    const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
    if (modal) {
        modal.hide();
        // Asegurar que el enfoque salga del modal
        const modalElement = document.getElementById(modalId);
        modalElement.addEventListener('hidden.bs.modal', () => {
            document.body.focus(); // Mueve el enfoque al cuerpo u otro elemento accesible
        }, { once: true });
    }
});



//Frontend: control-modales.js escucha los eventos y ejecuta la lógica de Bootstrap (abrir o cerrar modales).
