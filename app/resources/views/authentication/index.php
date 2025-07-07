<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?= APP_URL ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app/css/styles.css" type="text/css">
    <link rel="stylesheet" href="app/css/authentication/index.css">
    <script type="module" src="app/js/authentication/index.js" defer></script>

    <title>Iniciar Sesión</title>
</head>
<body class="body d-flex justify-content-center align-items-center">

    <form class="form-authentication" id="formUsuario" action="" autocomplete="off">
        <div class="card card-body m-3 gap-2">
            <div class="d-flex justify-content-center">
                <img src="http://localhost/lab_prog_2025_reales_ivan/public/app/assets/svg/imagotipo.svg" alt="">
            </div>

            <div class="mb-3">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" minlength="2" maxlength="50"  required>
            </div>

            <div class="mb-3">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" class="form-control" minlength="8" required>
            </div>
            <button type="button" class="login-btn btn  border-0 text-light" id="btn-login">Ingresar</button>
        </div>
    </form>
    
</body>
</html>