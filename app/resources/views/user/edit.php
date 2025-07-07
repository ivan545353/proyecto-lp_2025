    
        <section class="mb-4">
            <h1 class="h3 text-black">Editar Usuario</h1>
            <p class="text-muted">Visualice y edite los datos de la cuenta seleccionada</p>
        </section>
        
        <!-- Información adicional -->
        <section class="mb-3">
            <p><strong>Estado:</strong> <span id="estadoCuenta" class="badge bg-success">Activa</span></p>
            <p><strong>Fecha de creación:</strong> <span id="fechaCreacion"></span></p>
        </section>
        
        <!-- Formulario de edición -->
        <section>
            <form id="formUsuario" class="card card-body mb-4" autocomplete="off">
                <input type="hidden" id="id" name="id">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required disabled />
                    </div>
                    <div class="col-md-6">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required disabled />
                    </div>
                    <div class="col-md-6">
                        <label for="cuenta" class="form-label">Cuenta</label>
                        <input type="text" class="form-control" id="cuenta" name="cuenta" minlength="2" maxlength="50" required disabled />
                    </div>
                    <div class="col-md-6">
                        <label for="perfil" class="form-label">Perfil</label>
                        <select class="form-select" id="perfil" name="perfil" disabled>
                            <option value="Operador">Operador</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" disabled />
                    </div>
                    <div class="col-md-6">
                        <label for="clave" class="form-label">Clave</label>
                        <input type="password" class="form-control" id="clave" name="clave" minlength="8" disabled />
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" disabled>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                </div>
        
                <!-- Botonera -->
                <div class="mt-4 d-flex flex-wrap gap-2 filtros">
                    <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                    <button type="submit" class="btn btn-success" id="btnActualizar" disabled>Actualizar</button>
                    <button type="button" class="btn btn-secondary" id="btnCancelar" disabled>Cancelar</button>
                    <a href="user/index" class="btn btn-outline-dark">Volver</a>
                    <button type="button" class="btn btn-danger " id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-outline-primary" id="btnExportar">Exportar a PDF</button>
                </div>
        
                <!-- Mensajes -->
                <div id="mensajeActualizado" class="alert alert-success mt-4 d-none" role="alert">
                    Registro actualizado.
                </div>
                <div id="mensajeEliminado" class="alert alert-danger mt-4 d-none" role="alert">
                    Registro eliminado.
                </div>
            </form>
        </section>
