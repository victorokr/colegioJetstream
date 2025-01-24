// Toast reutilizable para éxito (Create/Edit)
export const showToast = (message) => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: message,
    });
};


// Confirmación reutilizable para Delete
export const showConfirmation = (title, text, confirmText, cancelText, callback) => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-2",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            callback(); // Ejecuta la acción si se confirma
            swalWithBootstrapButtons.fire({
                title: "Eliminado",
                text: "El registro ha sido eliminado correctamente.",
                icon: "success"
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La acción fue cancelada.",
                icon: "error"
            });
        }
    });
};
