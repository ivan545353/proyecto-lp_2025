import { itemController } from './controller.js';

const form = document.getElementById('formEditarProducto');
const btnEditar = document.getElementById('btnEditar');
const btnActualizar = document.getElementById('btnActualizar');
const btnCancelar = document.getElementById('btnCancelar');
const btnEliminar = document.getElementById('btnEliminar');
const btnExportar = document.getElementById('btnExportar');

const mensajeActualizado = document.getElementById('mensajeActualizado');
const mensajeEliminado = document.getElementById('mensajeEliminado');

// Obtener el ID desde la URL amigable
function getIdFromFriendlyUrl() {
    const parts = window.location.pathname.split('/').filter(Boolean);
    const id = parseInt(parts[parts.length - 1], 10);
    return isNaN(id) ? null : id;
}

const id = getIdFromFriendlyUrl();

document.addEventListener('DOMContentLoaded', async () => {
    if (!id) {
        alert("ID de producto inválido.");
        location.href = "/lab_prog_2025_reales_ivan/public/item/index";
        return;
    }

    await cargarCategorias();
    await itemController.load(id);
    document.getElementById('btnExportar')?.addEventListener('click', () => {
        itemController.exportListToPDF();
    });
});

// Evento: Habilitar edición
btnEditar.addEventListener('click', () => {
    itemController.enableForm(true);
    btnActualizar.disabled = false;
    btnCancelar.disabled = false;
    btnEditar.disabled = true;
});



// Evento: Cancelar edición
btnCancelar.addEventListener('click', async () => {
    await itemController.load(id);
    btnActualizar.disabled = true;
    btnCancelar.disabled = true;
    btnEditar.disabled = false;
});

// Evento: Actualizar producto
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const datosActualizados = itemController.getFormData();
    await itemController.update(datosActualizados);

    mensajeActualizado.classList.remove('d-none');
    mensajeActualizado.scrollIntoView({ behavior: 'smooth', block: 'center' });

    setTimeout(() => {
        mensajeActualizado.classList.add('d-none');
    }, 3000);

    btnActualizar.disabled = true;
    btnCancelar.disabled = true;
    btnEditar.disabled = false;
});

// Evento: Eliminar producto
btnEliminar.addEventListener('click', async () => {
    await itemController.delete(id);
    mensajeEliminado.classList.remove('d-none');

    setTimeout(() => {
        location.href = "/lab_prog_2025_reales_ivan/public/item/index";
    }, 2000);
});

// Evento: Exportar a PDF
btnExportar.addEventListener('click', () => {
    itemController.exportToPDF();
    alert("Producto exportado a PDF con éxito");
});

// Función para cargar categorías desde el backend
async function cargarCategorias() {
    try {
        const response = await fetch('/lab_prog_2025_reales_ivan/public/category/list');
        const data = await response.json();
        const categorias = data.result;

        const selectCategoria = document.querySelector('#categoria');
        selectCategoria.innerHTML = '<option value="">Seleccione una categoría</option>';

        categorias.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id;
            option.textContent = cat.nombre;
            selectCategoria.appendChild(option);
        });
    } catch (error) {
        console.error('Error cargando categorías:', error);
        alert('No se pudieron cargar las categorías');
    }
}
