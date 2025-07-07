<section class="mb-4">
    <h1 class="h3 text-black">Alta de Usuario</h1>
    <p class="text-muted">Complete el formulario para registrar una nueva cuenta</p>
</section>

<!-- Formulario de alta de usuario -->
<section>
    <form action="" id="formUsuario" class="card card-body mb-4" autocomplete="off">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required>
            </div>
            <div class="col-md-6">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" minlength="2" maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-']+" required>
            </div>
            <div class="col-md-6">
                <label for="cuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" name="cuenta" minlength="2" maxlength="50" required>
            </div>
            <div class="col-md-6">
                <label for="perfil" class="form-label">Perfil</label>
                <select class="form-select" id="perfil" name="perfil" required>
                    <option value="" disabled selected>Seleccione un perfil</option>
                    <option value="operador">Operador</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="col-md-6">
                <label for="clave" class="form-label">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" minlength="8" required>
            </div>
            <div class="col-md-6">
                <label for="confirmarClave" class="form-label">Confirmación de la clave</label>
                <input type="password" class="form-control" id="confirmarClave" name="confirmarClave" minlength="8" required>
            </div>
        </div>

        <div class="mt-4 d-flex gap-3 filtros flex-wrap">
            <button type="submit" class="btn btn-dark">Guardar</button>
            <a href="user/index" class="btn btn-outline-secondary">Volver</a>
        </div>

        <!-- Mensaje de éxito -->
        <div id="mensajeExito" class="alert alert-success mt-4 d-none" role="alert">
            Registro creado.
        </div>
    </form>
</section>