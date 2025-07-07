import { userController } from './controller.js';

document.addEventListener('DOMContentLoaded', async () => {
    // Mostramos la tabla de usuarios al cargar
    await userController.list();

    // Exportar a PDF
    const exportBtn = document.querySelector('#btnExportar');
    exportBtn?.addEventListener('click', async () => {
        await userController.exportToPDF();
    });

    // Filtros
    const filtroCuenta = document.getElementById("filtroCuenta");
    const filtroCorreo = document.getElementById("filtroCorreo");
    const filtroPerfil = document.getElementById("filtroPerfil");

    // Aplicar filtros
    const aplicarFiltros = async () => {
        const filtros = {
            cuenta: filtroCuenta.value.trim().toLowerCase(),
            correo: filtroCorreo.value.trim().toLowerCase(),
            perfil: filtroPerfil.value.trim().toLowerCase(),
        };

        await userController.list(filtros);
    };

    filtroCuenta.addEventListener("input", aplicarFiltros);
    filtroCorreo.addEventListener("input", aplicarFiltros);
    filtroPerfil.addEventListener("change", aplicarFiltros);
});
