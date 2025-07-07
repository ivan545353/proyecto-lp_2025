import { categoryController } from './controller.js';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formCategoria');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const nuevaCategoria = categoryController.getFormData();
        if (!nuevaCategoria) return;

        await categoryController.save();
    });
});
