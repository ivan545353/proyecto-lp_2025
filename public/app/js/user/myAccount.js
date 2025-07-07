import { userController } from './controller.js';

document.addEventListener('DOMContentLoaded', async () => {
    await userController.loadCurrentUser();

    const form = document.getElementById("changePasswordForm");
    const button = document.getElementById("updatePasswordButton");

    button.addEventListener('click', async () => {
        const currentPassword = form.currentPassword.value.trim();
        const newPassword = form.newPassword.value.trim();
        const confirmPassword = form.confirmPassword.value.trim();

        if (!currentPassword || !newPassword || !confirmPassword) {
            alert("Todos los campos de contraseña son obligatorios");
            return;
        }

        await userController.changePassword(currentPassword, newPassword, confirmPassword);
    });
});
