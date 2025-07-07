<nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container-fluid gap-3">
            <!-- Logo -->
            <a class="navbar-brand" href="home/index">
                <img src="<?= APP_URL . 'app/assets/svg/imagotipo.svg' ?>" alt="Logo"
                    height="40">
            </a> 
    
            <!-- Botón del menú en modo responsive -->
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> 
    
            <!-- Contenido del menú -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="home/index">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="item/index">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="category/index">Categorías</a>
                    </li>
                    <?php if ($_SESSION['perfil'] === 'Administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="user/index">Usuarios</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="javascript:void(0)" onclick="alertar()">Ventas</a>
                    </li>
                </ul>

                <!-- Dropdown "Mi cuenta" -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Mi cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="user/myAccount">Mis datos <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg></a></li>
                            <li><a class="dropdown-item" href="authentication/logout">Cerrar sesión <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
</svg></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function alertar() {
            alert("Funcionalidad en desarrollo");
        }
    </script>