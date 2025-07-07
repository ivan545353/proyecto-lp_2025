<div class="container py-4">
        <h1 class="mb-4">Editar Producto</h1>
    
        <form id="formEditarProducto" autocomplete="off">
            <input type="hidden" id="id" name="id">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required disabled>
                </div>
                <div class="col-md-6">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" id="codigo" name="codigo" class="form-control" required disabled>
                </div>
                <div class="col-md-6">
                    <label for="categoria" class="form-label">Categoría</label>
                    <select id="categoria" name="categoria" class="form-select" required disabled >
                        <option value="">Seleccione una categoría</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" id="precio" name="precio" class="form-control" step="0.01" required disabled>
                </div>
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control" required disabled>
                </div>
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3" minlength="10" disabled></textarea>
                </div>
            </div>
    
            <div id="mensajeActualizado" class="alert alert-success d-none" role="alert">
                Producto actualizado correctamente.
            </div>
            <div id="mensajeEliminado" class="alert alert-warning d-none" role="alert">
                Producto eliminado correctamente.
            </div>
            
            <div class="mt-4 d-flex flex-wrap gap-2 filtros">
                    <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                    <button type="submit" class="btn btn-success" id="btnActualizar" disabled>Actualizar</button>
                    <button type="button" class="btn btn-secondary" id="btnCancelar" disabled>Cancelar</button>
                    <a href="item/index" class="btn btn-outline-dark">Volver</a>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-outline-primary" id="btnExportar">Exportar a PDF</button>
            </div>
        </form>
    </div>
