// Seleccionar todas las imágenes de contraseña
const togglePasswordImages = document.querySelectorAll('.img-password');

togglePasswordImages.forEach(img => {
    const inputId = img.getAttribute('data-input');  // Obtener el ID del input correspondiente
    const passwordInput = document.getElementById(inputId);  // Asociar el input

    img.addEventListener('mousedown', function () {
        // Mostrar la contraseña al hacer clic en la imagen
        passwordInput.type = 'text';
    });

    img.addEventListener('mouseup', function () {
        // Volver a esconder la contraseña al soltar el clic
        passwordInput.type = 'password';
    });

    img.addEventListener('mouseout', function () {
        // Asegurarse de volver a esconder la contraseña si se sale del área de la imagen
        passwordInput.type = 'password';
    });
});