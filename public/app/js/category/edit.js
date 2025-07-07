import { categoryController } from './controller.js';

const form = document.getElementById('formCategoria');
const btnEditar = document.getElementById('btnEditar');
const btnActualizar = document.getElementById('btnActualizar');
const btnCancelar = document.getElementById('btnCancelar');
const btnEliminar = document.getElementById('btnEliminar');
const btnExportar = document.getElementById('btnExportar');

const mensajeActualizado = document.getElementById('mensajeActualizado');
const mensajeEliminado = document.getElementById('mensajeEliminado');

// Obtener ID desde la URL
function getIdFromUrl() {
    const parts = window.location.pathname.split('/').filter(Boolean);
    const id = parseInt(parts[parts.length - 1], 10);
    return isNaN(id) ? null : id;
}

const id = getIdFromUrl();

document.addEventListener('DOMContentLoaded', async () => {
    if (!id) {
        alert("ID de categoría inválido.");
        location.href = "/lab_prog_2025_reales_ivan/public/category/index";
        return;
    }

    await categoryController.load(id);
});

// Evento: Habilitar formulario
btnEditar.addEventListener('click', () => {
    categoryController.enableForm(true);
    btnActualizar.disabled = false;
    btnCancelar.disabled = false;
    btnEditar.disabled = true;
});

// Evento: Cancelar edición
btnCancelar.addEventListener('click', async () => {
    await categoryController.load(id);
    btnActualizar.disabled = true;
    btnCancelar.disabled = true;
    btnEditar.disabled = false;
});

// Evento: Actualizar categoría
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const categoria = categoryController.getFormData();
    const response = await categoryController.update(categoria);

    if (response.error) return; // ya alertó internamente

    mensajeActualizado.classList.remove('d-none');
    mensajeActualizado.scrollIntoView({ behavior: 'smooth', block: 'center' });

    setTimeout(() => mensajeActualizado.classList.add('d-none'), 3000);

    btnActualizar.disabled = true;
    btnCancelar.disabled = true;
    btnEditar.disabled = false;
});

// Evento: Eliminar categoría
btnEliminar.addEventListener('click', async () => {
    const eliminado = await categoryController.delete(id);
    if (eliminado) {
        mensajeEliminado.classList.remove('d-none');
        setTimeout(() => {
            location.href = "/lab_prog_2025_reales_ivan/public/category/index";
        }, 2000);
    }
});

// Evento: Exportar a PDF
btnExportar.addEventListener('click', () => {
    categoryController.exportToPDF(id);
});
