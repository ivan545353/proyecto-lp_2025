import { authenticationController } from './controller.js';

document.addEventListener("DOMContentLoaded", () => {
   
    const btnLogin = document.getElementById("btn-login");
    btnLogin.addEventListener("click", () => {
        console.log("Botón de inicio de sesión presionado");
        const account = document.getElementById("usuario").value;
        const password = document.getElementById("contraseña").value;

        if (account === "" || password === "") {
            console.error("Los campos de usuario y contraseña no pueden estar vacíos.");
            alert("Por favor, complete ambos campos.");
            return;
        }
        console.log("Cuenta: ", account , " Contraseña: ", password);
        authenticationController.login(account, password);
    });
})