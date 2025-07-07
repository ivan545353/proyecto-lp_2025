import { itemService } from './service.js';

export const itemController = {
    async list(filtros = {}) {
        const tbody = document.querySelector("#tablaItems tbody");
        if (!tbody) return;

        tbody.innerHTML = "";

        const items = await itemService.list(filtros);

        items.forEach(item => {
            const tr = document.createElement("tr");
            if (item.stock === 0) tr.classList.add("table-danger");

            tr.innerHTML = `
                <td>${item.nombre}</td>
                <td>${item.codigo}</td>
                <td>${item.descripcion}</td>
                <td>${item.categoria}</td>
                <td>${item.precio}</td>
                <td>${item.stock}</td>
                <td>
                    <div class="btn-group">
                        <a href="/lab_prog_2025_reales_ivan/public/item/edit/${item.id}" class="btn btn-sm btn-outline-primary">Editar</a>
                        <button class="btn btn-sm btn-outline-danger btn-eliminar" data-id="${item.id}">Eliminar</button>
                    </div>
                </td>
            `;

            tbody.appendChild(tr);
        });

        document.querySelectorAll(".btn-eliminar").forEach(btn => {
            btn.addEventListener("click", () => {
                const id = parseInt(btn.dataset.id);
                this.delete(id);
            });
        });
    },

    async save(producto) {
        const response = await itemService.save(producto);
        alert(response.message);
        await this.list();
    },

    async update(producto) {
        const response = await itemService.update(producto);
        alert(response.message);
        this.enableForm(false);
        await this.list();
    },

    async delete(id) {
        if (!confirm("¿Estás seguro que deseas eliminar este producto?")) return;

        const response = await itemService.delete(id);
        alert(response.message);
        await this.list(); // Refrescar lista tras eliminar
    },

    async load(id) {
        const producto = await itemService.load(id);
        if (producto) {
            this.fillForm(producto);
            this.enableForm(false);
        }
    },

    getFormData() {
        const form = document.getElementById('formEditarProducto') || document.getElementById('formProducto');

        const id = form.id?.value ? parseInt(form.id.value) : null;

        return {
            id,
            nombre: form.nombre.value.trim(),
            codigo: form.codigo.value.trim(),
            descripcion: form.descripcion.value.trim(),
            categoriaId: parseInt(form.categoria.value),
            categoria: form.categoria.value.trim(),
            precio: parseFloat(form.precio.value),
            stock: parseInt(form.stock.value)
        };
    },

    fillForm(item) {
        document.getElementById('id').value = item.id;
        document.getElementById('nombre').value = item.nombre;
        document.getElementById('codigo').value = item.codigo;
        document.getElementById('descripcion').value = item.descripcion;
        document.getElementById('categoria').value = item.categoriaId;  // Selección correcta
        document.getElementById('precio').value = item.precio;
        document.getElementById('stock').value = item.stock;
    },

    enableForm(enable = true) {
        const form = document.getElementById("formEditarProducto") || document.getElementById("formProducto");
        Array.from(form.elements).forEach(el => {
            if (el.tagName !== "BUTTON") el.disabled = !enable;
        });
    },

    async exportToPDF() {
        const doc = new window.jspdf.jsPDF();
        const producto = this.getFormData();

        doc.setFontSize(18);
        doc.setFont("helvetica", "bold");
        doc.text("Ficha de Producto", 10, 20);

        doc.setDrawColor(150);
        doc.line(10, 25, 200, 25);

        doc.setFontSize(12);
        doc.setFont("helvetica", "normal");

        const datos = [
            { label: "Nombre", value: producto.nombre },
            { label: "Código", value: producto.codigo },
            { label: "Categoría", value: producto.categoria },
            { label: "Precio", value: `$${Number(producto.precio).toFixed(2)}` },
            { label: "Stock", value: producto.stock },
        ];

        let y = 35;
        datos.forEach(dato => {
            doc.text(`${dato.label}:`, 10, y);
            doc.setFont("helvetica", "bold");
            doc.text(`${dato.value}`, 50, y);
            doc.setFont("helvetica", "normal");
            y += 10;
        });

        doc.text("Descripción:", 10, y);
        doc.setFont("helvetica", "bold");
        const splitDescripcion = doc.splitTextToSize(producto.descripcion, 180);
        doc.text(splitDescripcion, 10, y + 10);

        const pageHeight = doc.internal.pageSize.height;
        const fecha = new Date().toLocaleString();

        doc.setFontSize(10);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(150);
        doc.text("CompuStack - Sistema de Gestión", 10, pageHeight - 20);
        doc.text(`Exportado: ${fecha}`, 10, pageHeight - 10);

        const nombreArchivo = `${producto.nombre.replace(/\s+/g, '_')}_datos.pdf`;
        doc.save(nombreArchivo);
    },
    async exportListToPDF() {
        const filtroCodigo = document.getElementById("filtroCodigo")?.value.trim();
        const filtroNombre = document.getElementById("filtroNombre")?.value.trim();
        const filtroCategoria = document.getElementById("filtroCategoria")?.value.trim();
        const filtroStock = document.getElementById("filtroStock")?.value;

        const filters = {
            codigo: filtroCodigo,
            nombre: filtroNombre,
            categoria: filtroCategoria,
            stock: filtroStock
        };

        const items = await itemService.list(filters);

        const doc = new window.jspdf.jsPDF('p', 'pt');
        doc.setFontSize(18);
        doc.setFont("helvetica", "bold");
        doc.text("Listado de Productos", 40, 40);

        const fecha = new Date().toLocaleString();
        doc.setFontSize(10);
        doc.setFont("helvetica", "normal");
        doc.setTextColor(150);
        doc.text(`Exportado: ${fecha}`, 40, 60);

        // Columnas de la tabla
        const columns = [
            { header: "Nombre", dataKey: "nombre" },
            { header: "Código", dataKey: "codigo" },
            { header: "Descripción", dataKey: "descripcion" },
            { header: "Categoría", dataKey: "categoria" },
            { header: "Precio", dataKey: "precio" },
            { header: "Stock", dataKey: "stock" },
        ];

        // Preparamos los datos formateados para la tabla
        const rows = items.map(item => ({
            nombre: item.nombre,
            codigo: item.codigo,
            descripcion: item.descripcion,
            categoria: item.categoria,
            precio: `$${Number(item.precio).toFixed(2)}`,
            stock: item.stock,
        }));

        // Usamos autoTable para generar la tabla
        doc.autoTable({
            startY: 80,
            head: [columns.map(c => c.header)],
            body: rows.map(r => columns.map(c => r[c.dataKey])),
            styles: { fontSize: 10 },
            headStyles: { fillColor: [52, 58, 64] },
            margin: { left: 40, right: 40 }
        });

        doc.save(`Listado_Productos_${fecha.replace(/[\/,: ]/g, '_')}.pdf`);
    }
};

