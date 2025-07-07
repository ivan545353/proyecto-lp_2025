        <div class="container mt-5">
            <h2 class="mb-4">Registrar Nuevo Producto</h2>
        
            <form id="formProducto" class="bg-white p-4 rounded shadow-sm" autocomplete="off">
                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" minlength="2" maxlength="100" required>
                </div>
        
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>
        
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" minlength="10"></textarea>
                </div>
        
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria" name="categoria" required size="5">
                        <option value="">Seleccione una categoría</option>
                    </select>
                </div>
        
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio ($)</label>
                    <input type="number" class="form-control" id="precio" name="precio" required min="0" step="any">
                </div>
        
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required min="0">
                </div>
        
                <div class="d-flex justify-content-start gap-3 filtros flex-wrap">
                    <button type="submit" class="btn btn-dark">Registrar Producto</button>
                    <a href="item/index" class="btn btn-secondary">Volver</a>
                </div>
            </form>
        
            <div id="mensajeExito" class="alert alert-success mt-3 d-none">
                Producto registrado correctamente.
            </div>
        </div>
