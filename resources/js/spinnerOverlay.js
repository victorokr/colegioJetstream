 // Ocultar el overlay de carga cuando la página termine de cargar
 window.addEventListener('load', function () {
    const loader = document.querySelector("#loader");
    loader.classList.add("spinner-div-hidden");

    loader.addEventListener("transitionend", () => {
        if (loader && loader.parentNode){
            loader.parentNode.removeChild(loader);
        }
        
    })
  });




  


// Selección del loader: const loader = document.querySelector("#loader"); selecciona el nodo loader correctamente.
// Añadir clase para ocultar: loader.classList.add("spinner-div-hidden"); inicia la transición para ocultar el overlay.
// Eliminar el nodo: En loader.addEventListener("transitionend", () => { ... }), se verifica que loader y loader.parentNode existan antes de llamar a removeChild. La línea document.body.removeChild("loader"); se ha corregido a loader.parentNode.removeChild(loader);.
// Este ajuste asegura que el overlay de carga se oculte correctamente y se elimine del DOM una vez que la transición de opacidad haya terminado.