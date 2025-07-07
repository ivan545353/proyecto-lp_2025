        <div class="container py-4">
            <h1 class="mb-4">Productos</h1>
            <div class="mb-3 d-flex gap-3 flex-wrap filtros">
                <input type="text" id="filtroCodigo" class="form-control" placeholder="Filtrar por código"
                    style="max-width: 200px;">
                <input type="text" id="filtroNombre" class="form-control" placeholder="Filtrar por nombre"
                    style="max-width: 200px;">
                <input type="text" id="filtroCategoria" class="form-control" placeholder="Filtrar por categoría"
                    style="max-width: 200px;">
                <select id="filtroStock" class="form-select" style="max-width: 200px;">
                    <option value="">Todo el stock</option>
                    <option value="disponible">Con stock</option>
                    <option value="agotado">Sin stock</option>
                </select>

                <button type="button" id="btnAplicarFiltros" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
  <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
</svg>Aplicar filtros
                </button>
                <button id="btnLimpiarFiltros" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser-fill" viewBox="0 0 16 16">
  <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293z"/>
</svg>Limpiar Filtros</button>
                <a href="item/create" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>Agregar producto</a>
                <a href="javascript:void(0)" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" id="btnExportar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                        <path
                            d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z" />
                        <path
                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg> Exportar listado
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaItems">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Se completa dinámicamente desde JS -->
                    </tbody>
                </table>

            </div>
        </div>
