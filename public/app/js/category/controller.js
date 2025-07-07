import { categoryService } from './service.js';

export const categoryController = {
    async load(id) {
        const categoria = await categoryService.load(id);
        if (!categoria) {
            alert("Categoría no encontrada");
            window.location.href = 'category/index';
            return;
        }
        this.fillForm(categoria);
        this.enableForm(false);
    },

    async save() {
        const categoria = this.getFormData();
        if (!categoria) return;

        const response = await categoryService.save(categoria);

        const mensajeExito = document.getElementById("mensajeExito");
        const mensajeError = document.getElementById("mensajeError");

        mensajeExito.classList.add("d-none");
        mensajeError.classList.add("d-none");

        if (response.error === "") {
            this.resetForm();
            mensajeExito.classList.remove("d-none");
            mensajeExito.scrollIntoView({ behavior: 'smooth' });
            this.list();
            setTimeout(() => {
                mensajeExito.classList.add('d-none');
            }, 3000);
        } else {
            mensajeError.textContent = response.error;
            mensajeError.classList.remove("d-none");
            mensajeError.scrollIntoView({ behavior: 'smooth' });
        }

        return response;
    },

    async update(categoria) {
        if (!categoria || !categoria.id) return;

        const response = await categoryService.update(categoria);

        if (response.error === "") {
            alert("Categoría actualizada con éxito");
            this.enableForm(false);
            this.list();
        } else {
            alert(response.error || "Error al actualizar la categoría.");
        }

        return response;
    },

    async delete(id) {
        const response = await categoryService.delete(id);
        if (response.error) {
            alert(response.message || "Error al eliminar la categoría.");
            return false;
        }

        alert(`Categoría con ID ${id} eliminada correctamente`);
        return true;
    },

    async list(filtros = {}) {
        const tbody = document.querySelector("#tablaUsuarios tbody");
        if (!tbody) return;

        tbody.innerHTML = "";

        const categorias = await categoryService.list();

        const filtradas = categorias.filter(cat => {
            const nombre = cat.nombre.toLowerCase();
            const filtroNombre = (filtros.nombre || "").toLowerCase();
            return nombre.includes(filtroNombre);
        });

        filtradas.forEach(cat => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${cat.nombre}</td>
                <td class="d-flex justify-content-center">
                    <div class="btn-group">
                        <a href="/lab_prog_2025_reales_ivan/public/category/edit/${cat.id}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <button class="btn btn-sm btn-outline-danger btn-eliminar" data-id="${cat.id}">Eliminar</button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });

        document.querySelectorAll(".btn-eliminar").forEach(btn => {
            btn.addEventListener("click", async () => {
                const id = parseInt(btn.dataset.id);
                if (!confirm("¿Está seguro que desea eliminar esta categoría?")) return;

                const eliminado = await this.delete(id);
                if (eliminado) {
                    await this.list(filtros);  // recarga la tabla con filtros actuales
                }
            });
        });
    },


    async exportToPDF(id = null) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const autor = "Sistema de Gestión - Desarrollado por Iván Reales";
        const fecha = new Date().toLocaleString();

        if (id) {
            // Exportar ficha individual
            const cat = await categoryService.load(id);
            if (!cat) {
                alert("Categoría no encontrada");
                return;
            }

            const titulo = `Ficha de Categoría: ${cat.nombre}`;

            doc.setFontSize(18);
            doc.setTextColor(33, 37, 41);
            doc.text(titulo, 14, 20);
            doc.setDrawColor(200);
            doc.line(14, 22, 196, 22);

            doc.setFontSize(12);
            doc.setTextColor(100);
            doc.text("Nombre:", 20, 35);
            doc.setTextColor(0);
            doc.text(cat.nombre, 60, 35);

            doc.setDrawColor(200);
            doc.line(14, 50, 196, 50);
            doc.setFontSize(10);
            doc.setTextColor(120);
            doc.text(autor, 14, 58);
            doc.text(`Fecha de generación: ${fecha}`, 14, 64);

            doc.save(`categoria_${cat.id}.pdf`);
        } else {
            // Exportar listado completo
            const categorias = await categoryService.list();
            const rows = categorias.map(cat => [cat.nombre]);

            doc.setFontSize(16);
            doc.text("Listado de Categorías", 14, 15);

            doc.autoTable({
                startY: 25,
                head: [["Nombre"]],
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

            doc.save("categorias.pdf");
        }
    },

    resetForm() {
        const form = document.getElementById("formCategoria");
        form.reset();

        const inputId = form.querySelector('[name="id"]');
        if (inputId) {
            inputId.value = "";
        }
    },

    enableForm(enable = true) {
        const form = document.getElementById("formCategoria");
        Array.from(form.elements).forEach(el => {
            if (el.tagName !== "BUTTON") el.disabled = !enable;
        });
    },

    getFormData() {
        const form = document.getElementById("formCategoria");
        const id = form.id.value ? parseInt(form.id.value) : null;

        const categoria = {
            id,
            nombre: form.nombre.value.trim()
        };

        if (!categoria.nombre) {
            alert("El nombre de la categoría es obligatorio");
            return null;
        }

        return categoria;
    },

    fillForm(cat) {
        const form = document.getElementById("formCategoria");
        form.id.value = cat.id;
        form.nombre.value = cat.nombre;
    }
};
