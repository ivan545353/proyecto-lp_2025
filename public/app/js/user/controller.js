import { userService } from './service.js';

export const userController = {
    //Solicita al servicio una cuenta existente y lo muestra en la vista 
    async load(id) {
        const user = await userService.load(id);
        if (!user) {
            alert("Usuario no encontrado");
            window.location.href = 'user/index';
            return;
        }
        this.fillForm(user);
        this.enableForm(false);
    },
    //Crea una cuenta con los datos de la vista y lo envía al servicio para persistir 
    async save() {
        const user = this.getFormData();
        if (!user) return;

        const response = await userService.save(user);
        this.resetForm();
        alert("Cuenta registrada con éxito");
        this.list();

        return response; // Devuelve el objeto completo al caller
    },
    // Crea una cuenta con los datos de la vista y lo envía al servicio para persistir 
    async update(user) {
        if (!user || !user.id) return;

        await userService.update(user);
        alert("Cuenta actualizada con éxito");
        this.enableForm(false);
        this.list();
        console.log("usuario actualizado \n",user);
    },
    // Solicita al servicio eliminar una cuenta existente y actualizar la vista 
    async delete(id) {
        if (!confirm("¿Está seguro que desea eliminar esta cuenta?")) return;

        await userService.delete(id);
        alert(`Cuenta con ID ${id} eliminada correctamente`);
        this.list();
    },
    //Solicita al servicio las cuentas existentes y las muestra en la vista 
    async list(filtros = {}) {
        const tbody = document.querySelector("#tablaUsuarios tbody");
        if (!tbody) return; // ← Evita error si no hay tabla 

        tbody.innerHTML = "";

        const users = await userService.list();

        const usuariosFiltrados = users.filter(user => {
            const cuenta = user.cuenta.toLowerCase();
            const correo = user.correo.toLowerCase();
            const perfil = user.perfil.toLowerCase();

            const filtroCuenta = filtros.cuenta || "";
            const filtroCorreo = filtros.correo || "";
            const filtroPerfil = filtros.perfil || "";

            return (
                cuenta.includes(filtroCuenta) &&
                correo.includes(filtroCorreo) &&
                (filtroPerfil === "" || perfil === filtroPerfil)
            );
        });

        usuariosFiltrados.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${user.nombres} ${user.apellido}</td>
            <td>${user.cuenta}</td>
            <td>${user.perfil}</td>
            <td>${user.correo}</td>
            <td>
                <div class="btn-group">
                    <a href="/lab_prog_2025_reales_ivan/public/user/edit/${user.id}" class="btn btn-sm btn-outline-primary">Editar</a>
                    <button class="btn btn-sm btn-outline-danger btn-eliminar" data-id="${user.id}">Eliminar</button>
                </div>
            </td>
        `;
            tbody.appendChild(row);
        });

        document.querySelectorAll(".btn-eliminar").forEach(btn => {
                btn.addEventListener("click", () => {
                const id = parseInt(btn.dataset.id);
                this.delete(id);
            });
        });
    },
    //Genera un archivo PDF  con el listado de cuentas de usuario si no tiene identificador
    //Genera un archivo PDF  con la ficha de un usuario si tiene identificador
    async exportToPDF(id = null) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const titulo = id ? "Ficha del Usuario" : "Listado de Usuarios";
        const autor = "Sistema de Gestión - Desarrollado por Iván Reales";
        const fecha = new Date().toLocaleString();

        doc.setFontSize(16);
        doc.text(titulo, 14, 15);

        if (id) {
            // Ficha individual
            const user = await userService.load(id);
            if (!user) {
                alert("Usuario no encontrado");
                return;
            }

            const fecha = new Date().toLocaleString();
            const titulo = `Ficha de Usuario: ${user.apellido}, ${user.nombres}`;
            const autor = "Sistema de Gestión de Usuarios - Desarrollado por Iván Reales";

            // Encabezado
            doc.setFontSize(18);
            doc.setTextColor(33, 37, 41);
            doc.text(titulo, 14, 20);

            doc.setDrawColor(200);
            doc.line(14, 22, 196, 22); 

            // Datos del usuario como filas
            doc.setFontSize(12);
            const datos = [
                ["Apellido", user.apellido],
                ["Nombres", user.nombres],
                ["Cuenta", user.cuenta],
                ["Correo", user.correo],
                ["Perfil", user.perfil]
            ];

            let y = 30;
            datos.forEach(([campo, valor]) => {
                doc.setTextColor(100);
                doc.text(`${campo}:`, 20, y);
                doc.setTextColor(0);
                doc.text(`${valor}`, 60, y);
                y += 10;
            });

            // Pie de página
            doc.setDrawColor(200);
            doc.line(14, y + 2, 196, y + 2);

            doc.setFontSize(10);
            doc.setTextColor(120);
            doc.text(autor, 14, y + 10);
            doc.text(`Fecha de generación: ${fecha}`, 14, y + 16);

            doc.save(`usuario_${user.id}.pdf`);
        } else {
            // Listado de usuarios
            const users = await userService.list();
            const rows = users.map(user => [
                `${user.apellido}, ${user.nombres}`,
                user.cuenta,
                user.correo,
                user.perfil
            ]);

            doc.autoTable({
                startY: 25,
                head: [["Nombre", "Cuenta", "Correo", "Perfil"]],
                body: rows,
                theme: 'striped',
                styles: { fontSize: 10 },
                headStyles: { fillColor: [33, 37, 41] },
                alternateRowStyles: { fillColor: [245, 245, 245] },
                margin: { top: 25 }
            });

            const finalY = doc.lastAutoTable.finalY || 25;
            doc.setFontSize(10);
            doc.text(autor, 14, finalY + 10);
            doc.text(`Fecha de generación: ${fecha}`, 14, finalY + 16);

            doc.save("usuarios.pdf");
        }
    },

    //Resetea un formulario de la vista y restaura los valores por defecto
    resetForm() {
        const form = document.getElementById("formUsuario");
        form.reset();
        
        const inputId = form.querySelector('[name="id"]');
        if (inputId) {
            inputId.value = "";
        }
    },
    
    // Habilita o deshabilita todos los controles del formulario de la vista
    enableForm(enable = true) {
        const form = document.getElementById("formUsuario");
        Array.from(form.elements).forEach(el => {
            if (el.tagName !== "BUTTON") el.disabled = !enable;
        });
    },

    getFormData() {
        const form = document.getElementById("formUsuario");
        const id = form.id.value ? parseInt(form.id.value) : null;

        const user = {
            id: id,
            apellido: form.apellido.value.trim(),
            nombres: form.nombres.value.trim(),
            cuenta: form.cuenta.value.trim(),
            correo: form.correo.value.trim(),
            perfil: form.perfil.value.trim(),
            clave: form.clave.value.trim(),
            confirmarClave: form.confirmarClave?.value.trim(),
        };

        if (form.estado) {
            user.estado = parseInt(form.estado.value);
        }

        if (!user.apellido || !user.nombres || !user.cuenta || !user.correo || !user.perfil) {
            alert("Todos los campos son obligatorios");
            return null;
        }

        return user;
    },

    fillForm(user) {
        const form = document.getElementById("formUsuario");
        form.id.value = user.id;
        form.apellido.value = user.apellido;
        form.nombres.value = user.nombres;
        form.cuenta.value = user.cuenta;
        form.correo.value = user.correo;

        // Establecer el valor del select "perfil" de forma robusta
        const perfilSelect = form.perfil;
        const wasDisabled = perfilSelect.disabled;
        perfilSelect.disabled = false;

        const userPerfil = (user.perfil || "").trim().toLowerCase();
        let matchFound = false;

        for (let option of perfilSelect.options) {
            const optionValue = option.value.trim().toLowerCase();
            if (optionValue === userPerfil) {
                option.selected = true;
                matchFound = true;
                break;
            }
        }

        if (!matchFound) {
            // En caso de no encontrar coincidencia, selecciona la primera opción por defecto
            perfilSelect.selectedIndex = 0;
        }

        if (wasDisabled) perfilSelect.disabled = true;
        
        document.getElementById("fechaCreacion").textContent = user.fechaAlta || "Fecha no disponible";
        document.getElementById("estadoCuenta").textContent = user.estado ? "Habilitado" : "Deshabilitado";

        // Establecer el valor del select "estado"
        const estadoSelect = form.estado;
        const wasEstadoDisabled = estadoSelect.disabled;
        estadoSelect.disabled = false;

        const userEstado = String(user.estado).trim(); // "1" o "0"

        let estadoMatch = false;
        for (let option of estadoSelect.options) {
            if (option.value === userEstado) {
                option.selected = true;
                estadoMatch = true;
                break;
            }
        }

        if (!estadoMatch && userEstado !== "0" && userEstado !== "1") {
            estadoSelect.selectedIndex = 0; // por defecto Habilitado solo si no es 0 ni 1
        }


        if (wasEstadoDisabled) estadoSelect.disabled = true;

        if (!user.estado) {
            document.getElementById("estadoCuenta").classList.remove("bg-success");
            document.getElementById("estadoCuenta").classList.add("bg-danger");
        }
        console.log("Valor recibido de estado:", user.estado, typeof user.estado);

    },

    async getUsersFromService(){
        return await userService.list();
    },
    async loadCurrentUser() {
        const user = await userService.getCurrent();
        if (!user) {
            alert("No se pudo cargar el usuario actual");
            return;
        }

        const form = document.getElementById("myAccountForm");
        if (!form) return;

        form.apellido.value = user.apellido || "";
        form.nombres.value = user.nombres || "";
        form.cuenta.value = user.cuenta || "";
        form.correo.value = user.correo || "";
        form.perfil.value = user.perfil || "";
        form.fechaAlta.value = user.fechaAlta || "";
    },

    async changePassword(currentPassword, newPassword, confirmPassword) {
        const result = await userService.changePassword(currentPassword, newPassword, confirmPassword);

        const msgContainer = document.getElementById("passwordMessage");
        msgContainer.className = "mt-3"; // reset

        if (result.error) {
            msgContainer.textContent = result.error;
            msgContainer.classList.add("text-danger");
        } else {
            msgContainer.innerHTML = result.message;
            msgContainer.classList.add("text-success");

            document.getElementById("changePasswordForm").reset();
        }
    }
};
