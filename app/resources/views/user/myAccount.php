<div class="container mt-5">
    <h2 class="mb-4">Mi Cuenta</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="myAccountForm">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" id="nombres" name="nombres" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cuenta" class="form-label">Cuenta</label>
                        <input type="text" id="cuenta" name="cuenta" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" id="correo" name="correo" class="form-control" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="perfil" class="form-label">Perfil</label>
                        <input type="text" id="perfil" name="perfil" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="fechaAlta" class="form-label">Fecha de Alta</label>
                        <input type="text" id="fechaAlta" name="fechaAlta" class="form-control" disabled>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">Cambiar Contraseña</h5>
            <form id="changePasswordForm">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Contraseña Actual</label>
                    <input type="password" id="currentPassword" name="currentPassword" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nueva Contraseña</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
                <button type="button" class="btn btn-primary" id="updatePasswordButton">Actualizar Contraseña</button>
                <div id="passwordMessage" class="mt-3"></div>
            </form>
        </div>
    </div>
</div>