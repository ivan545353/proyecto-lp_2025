 <section class="mb-4">
            <h1 class="h3 text-black">Gestión de Categorías</h1>
            <p class="text-muted">Administración de categorías del sistema</p>
        </section>

        <!-- Sección de acciones -->
        <section class="mb-4 d-flex gap-3 flex-wrap filtros">
            <a href="category/create"
                class="btn btn-dark d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg> Crear nueva categoría</a>
            <a href="javascript:void(0)" class="btn btn-outline-secondary d-flex align-items-center" id="btnExportar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                    <path
                        d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707z" />
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                </svg> Exportar listado
            </a>
        </section>

        <!-- Sección de filtros -->
        <section class="mb-4">
            <div class="card card-body">
                <h5 class="card-title">Filtrar categorías</h5>
                <form class="row g-3">
                    <div class="mb-3 d-flex gap-2 flex-wrap filtros">
                        <input type="text" id="filtroNombre" placeholder="Filtrar por nombre de categoría" class="form-control">
                </form>
            </div>
        </section>

        <!-- Sección de tabla de usuarios -->
        <section>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tablaUsuarios">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Generación dinamica de la tabla con js -->
                    </tbody>
                </table>
            </div>
        </section>