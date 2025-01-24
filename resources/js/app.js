import './bootstrap';
import './dark_mode';

import './jquery';
import './parsley';

$('.validation-form').parsley();
import './parsley-spanish';

import './eye-input-password';
import './sidebar';
import './spinnerOverlay';
import './control-modales';

import { showToast, showConfirmation } from "./reutilizar-alertas";

// Haz disponibles estas funciones globalmente (opcional)
window.showToast = showToast;
window.showConfirmation = showConfirmation;
//console.log('Funciones globales registradas:', window.showToast, window.showConfirmation);
