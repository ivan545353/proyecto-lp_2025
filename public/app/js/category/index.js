import { categoryController } from './controller.js';

document.addEventListener('DOMContentLoaded', async () => {
    await categoryController.list();

    // Exportar a PDF
    const exportBtn = document.querySelector('#btnExportar');
    exportBtn?.addEventListener('click', async () => {
        await categoryController.exportToPDF();
    });

    // Filtros
    const filtroNombre = document.getElementById("filtroNombre");

    const aplicarFiltros = async () => {
        const filtros = {
            nombre: filtroNombre.value.trim().toLowerCase(),
        };
        await categoryController.list(filtros);
    };

    filtroNombre.addEventListener("input", aplicarFiltros);

});
