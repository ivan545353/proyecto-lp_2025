import {itemController} from './controller.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#formProducto');
    const mensajeExito = document.querySelector('#mensajeExito');

    cargarCategorias(); 

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const producto = itemController.getFormData();
        // Guardamos el nuevo producto
        await itemController.save(producto);

        // Mostramos mensaje de éxito
        mensajeExito.classList.remove('d-none');
        mensajeExito.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Limpiamos el formulario
        form.reset();

        // Ocultamos el mensaje luego de 7 segundos
        setTimeout(() => {
            mensajeExito.classList.add('d-none');
        }, 7000);
    });
});

async function cargarCategorias() {
    try {
        const response = await fetch('category/list');
        const data = await response.json();       // data es el objeto completo
        const categorias = data.result;           // esto es lo que necesitamos

        const selectCategoria = document.querySelector('#categoria');
        categorias.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id; 
            option.textContent = cat.nombre;
            selectCategoria.appendChild(option);
        });
    } catch (error) {
        console.error('Error cargando categorías:', error);
    }
}
