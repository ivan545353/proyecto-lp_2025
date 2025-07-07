import { authenticationService } from "./service.js";

export const authenticationController = {
    login: (cuenta, clave) => {
        const dataAccount = { cuenta, clave }

        console.log("Datos de inicio de sesión: ", dataAccount);

        authenticationService.login(dataAccount)
            .then(response => {
                if (response.error === "" && response.message === "OK") {
                    console.log("Inicio de sesión exitoso");
                    window.location.href = "home";
                }
                else {
                    alert("Acceso denegado: Credenciales inválidas.")
                }
            })
            .catch(error => {
                alert("Error de conexión: No se pudo conectar con el servidor.");
            })
    }
}