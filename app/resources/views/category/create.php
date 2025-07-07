 <section class="mb-4">
            <h1 class="h3 text-black">Crear categoría</h1>
            <p class="text-muted">Complete el campo para registrar una nueva categoría</p>
        </section>

        <!-- Formulario de creación de categoría -->
        <section>
            <form action="" id="formCategoria" class="card card-body mb-4" autocomplete="off">
                <div class="d-flex gap-3 flex-wrap">
                    <div class="flex-grow-1">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required>
                    </div>
        
                <div class="mt-4 d-flex align-items-end  filtros flex-wrap btn-group">
                    <button type="submit" class="btn btn-dark">Guardar</button>
                    <a href="category/index" class="btn btn-outline-secondary">Volver</a>
                </div>
        
                
            </form>
        </section>
        <!-- Mensaje de éxito -->
            <div id="mensajeExito" class="alert alert-success mt-4 d-none" role="alert">
                Categoría creada con éxito.
            </div>

        <!-- Mensaje de error -->
        <div id="mensajeError" class="alert alert-danger mt-2 d-none" role="alert"></div>

