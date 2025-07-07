<?php if (isset($_SESSION["flash_error"])): ?>
    <script>
        alert("<?= $_SESSION["flash_error"] ?>");
    </script>
    <?php unset($_SESSION["flash_error"]); ?>
<?php endif; ?>

<section class="p-4 border rounded shadow-sm" style="min-height: 400px;">
    <?php
    $usuario = $_SESSION["usuario"] ?? "Usuario";
    $perfil = $_SESSION["perfil"] ?? "Perfil";
    ?>

    <div class="container">
        <h2 class="mb-4">¡Bienvenido, <?= htmlspecialchars($usuario) ?>!</h2>
        <p class="text-muted mb-4">Perfil: <strong><?= htmlspecialchars($perfil) ?></strong></p>

        <div class="row g-4">
            <!-- Estadísticas -->
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios registrados</h5>
                        <p class="display-5"><?= htmlspecialchars($_REQUEST["userCount"] ?? 0) ?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Productos disponibles</h5>
                        <p class="display-5"><?= htmlspecialchars($_REQUEST["itemCount"] ?? 0) ?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gpu-card" viewBox="0 0 16 16">
                            <path d="M4 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0m7.5-1.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
                            <path d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .5.5V4h13.5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H2v2.5a.5.5 0 0 1-1 0V2H.5a.5.5 0 0 1-.5-.5m5.5 4a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M9 8a2.5 2.5 0 1 0 5 0 2.5 2.5 0 0 0-5 0"/>
                            <path d="M3 12.5h3.5v1a.5.5 0 0 1-.5.5H3.5a.5.5 0 0 1-.5-.5zm4 1v-1h4v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title">Categorías</h5>
                        <p class="display-5"><?= htmlspecialchars($_REQUEST["categoryCount"] ?? 0) ?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- MODULO DE VENTAS NO IMPLEMENTADO EN ESTA VERSIÓN DE SISTEMA -->
            <div class="col-md-3 col-sm-6">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body">
                        <h5 class="card-title">Ventas hoy</h5>
                        <p class="display-5">0</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4>Resumen General</h4>
            <canvas id="dashboardChart" width="400" height="150"></canvas>
        </div>

        <hr class="my-5">

        <!-- Links rápidos -->
        <h4>Accesos rápidos</h4>
        <div class="d-flex flex-wrap gap-3 mt-3">
            <a href="user/index" class="btn btn-outline-primary">Usuarios</a>
            <a href="item/index" class="btn btn-outline-success">Productos</a>
            <a href="category/index" class="btn btn-outline-warning">Categorías</a>
            <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="alertar()">Ventas</a>
            <a href="user/myAccount" class="btn btn-outline-info">Mi Cuenta</a>
        </div>

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const ctx = document.getElementById('dashboardChart').getContext('2d');

        const userCount = Number('<?= $_REQUEST["userCount"] ?? 0 ?>');
        const itemCount = Number('<?= $_REQUEST["itemCount"] ?? 0 ?>');
        const categoryCount = Number('<?= $_REQUEST["categoryCount"] ?? 0 ?>');

        const dashboardChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Usuarios', 'Productos', 'Categorías'],
                datasets: [{
                    label: 'Cantidad',
                    data: [userCount, itemCount, categoryCount],
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.7)',   // azul (primary)
                        'rgba(25, 135, 84, 0.7)',    // verde (success)
                        'rgba(255, 193, 7, 0.7)'     // amarillo (warning)
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(255, 193, 7, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });

</script>

