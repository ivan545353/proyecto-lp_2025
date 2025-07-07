import { itemController } from './controller.js';

document.addEventListener('DOMContentLoaded', async () => {
    const filtroCodigo = document.getElementById("filtroCodigo");
    const filtroNombre = document.getElementById("filtroNombre");
    const filtroCategoria = document.getElementById("filtroCategoria");
    const filtroStock = document.getElementById("filtroStock");
    const btnAplicarFiltros = document.getElementById("btnAplicarFiltros");
    const btnLimpiarFiltros = document.getElementById("btnLimpiarFiltros");
    

    const aplicarFiltros = async () => {
        const filtros = {
            codigo: filtroCodigo.value.trim().toLowerCase(),
            nombre: filtroNombre.value.trim().toLowerCase(),
            categoria: filtroCategoria.value.trim().toLowerCase(),
            stock: filtroStock.value
        };

        await itemController.list(filtros);
    };

    const limpiarFiltros = async () => {
        filtroCodigo.value = '';
        filtroNombre.value = '';
        filtroCategoria.value = '';
        filtroStock.value = '';

        await itemController.list(); // recargar sin filtros
    };

    btnAplicarFiltros.addEventListener("click", aplicarFiltros);
    btnLimpiarFiltros.addEventListener("click", limpiarFiltros);

    await itemController.list(); // carga inicial

    document.getElementById('btnExportar')?.addEventListener('click', () => {
        itemController.exportListToPDF();
    });
});
