import { userController } from './controller.js';
// import { userService } from './service.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formUsuario');
    const mensajeExito = document.getElementById('mensajeExito');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const usuario = userController.getFormData();
        if (!usuario) return;

        if (!validarClaves(usuario.clave, usuario.confirmarClave)) {
            alert('Las claves no coinciden');
            return;
        }

        const { confirmarClave, ...usuarioSinConfirmar } = usuario;

        
        const response = await userController.save(usuarioSinConfirmar);

        if (response && response.error === '') {
            // Éxito
            mensajeExito.classList.remove('d-none');
            mensajeExito.scrollIntoView({ behavior: 'smooth', block: 'center' });

            setTimeout(() => {
                mensajeExito.classList.add('d-none');
            }, 7000);
        } else {
            alert(`Error: ${response.message || 'No se pudo guardar el usuario.'}`);
        }
    });

});

// Valida que las claves sean iguales
function validarClaves(clave, confirmarClave) {
    return clave === confirmarClave;
}