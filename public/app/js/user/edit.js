import { userController } from './controller.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formUsuario');
    const btnEditar = document.getElementById('btnEditar');
    const btnActualizar = document.getElementById('btnActualizar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnEliminar = document.getElementById('btnEliminar');
    const btnExportar = document.getElementById('btnExportar');

    const mensajeActualizado = document.getElementById('mensajeActualizado');
    const mensajeEliminado = document.getElementById('mensajeEliminado');

    // Utilidad para obtener el ID desde la URL amigable
    function obtenerIdDesdeURL() {
        const partes = window.location.pathname.split('/');
        return parseInt(partes.at(-1));
    }

    const id = obtenerIdDesdeURL();

    // Validar ID
    if (isNaN(id)) {
        alert('ID de usuario no válido');
        window.location.href = '/lab_prog_2025_reales_ivan/public/user/index';
        return;
    }

    // Cargar los datos del usuario
    userController.load(id);

    // Botón "Editar"
    btnEditar.addEventListener('click', () => {
        userController.enableForm(true);
        btnActualizar.disabled = false;
        btnCancelar.disabled = false;
    });

    // Botón "Cancelar"
    btnCancelar.addEventListener('click', () => {
        userController.load(id); // Recarga los datos originales
        btnActualizar.disabled = true;
        btnCancelar.disabled = true;
    });

    // Evento "submit" del formulario
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const datosActualizados = userController.getFormData();
        if (!datosActualizados) return;


        // Ejecutar actualización
        await userController.update(datosActualizados);

        // Mostrar mensaje
        mensajeActualizado.classList.remove('d-none');
        mensajeActualizado.scrollIntoView({ behavior: 'smooth', block: 'center' });
        mensajeActualizado.focus({ preventScroll: true });

        setTimeout(() => {
            mensajeActualizado.classList.add('d-none');
        }, 3000);

        btnActualizar.disabled = true;
        btnCancelar.disabled = true;
    });

    // Botón "Eliminar"
    btnEliminar.addEventListener('click', () => {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            userController.delete(id);
            mensajeEliminado.classList.remove('d-none');

            setTimeout(() => {
                window.location.href = 'user/index';
            }, 2000);
        }
    });

    // Botón "Exportar"
    btnExportar.addEventListener('click', () => {
        userController.exportToPDF(id);
    });
});
