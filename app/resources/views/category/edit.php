<section class="mb-4">
    <h1 class="h3 text-black">Editar categoría</h1>
    <p class="text-muted">Visualice y edite el nombre de la categoría seleccionada</p>
    </section>
    
    <!-- Formulario de edición -->
    <section>
        <form id="formCategoria" class="card card-body mb-4" autocomplete="off">
            <input type="hidden" id="id" name="id">

                <div class="">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required disabled />
                </div>
    
            <!-- Botonera -->
            <div class="mt-4 d-flex flex-wrap gap-2 filtros">
                <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                <button type="submit" class="btn btn-success" id="btnActualizar" disabled>Actualizar</button>
                <button type="button" class="btn btn-secondary" id="btnCancelar" disabled>Cancelar</button>
                <a href="category/index" class="btn btn-outline-dark">Volver</a>
                <button type="button" class="btn btn-danger " id="btnEliminar">Eliminar</button>
                <button type="button" class="btn btn-outline-primary" id="btnExportar">Exportar a PDF</button>
            </div>
    
            <!-- Mensajes -->
            <div id="mensajeActualizado" class="alert alert-success mt-4 d-none" role="alert">
                Categoría actualizada.
            </div>
            <div id="mensajeEliminado" class="alert alert-danger mt-4 d-none" role="alert">
                Categoría eliminada.
            </div>
        </form>
</section>