const API_BASE_URL = "authentication/";

export const authenticationService = {
    login: (data) => {
        console.log("Enviando login con: ", JSON.stringify(data));
        return fetch(`${API_BASE_URL}login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                console.log("todo OK")
                throw new Error(`Error en la petición: ${response.status}`);
            }
            return response.json();
        })
        .catch (error => {
            console.log("Errorsadsads")
            console.error("Error en la petición", error);
            throw error;
        })
    }
} 