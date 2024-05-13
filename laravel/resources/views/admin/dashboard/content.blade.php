{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!-- Gráficos -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Gráficos</h5>
                    <!-- Aquí puedes agregar tus gráficos con ag-charts -->
                </div>
            </div>

            <!-- Likes, Posts, Comentarios -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Likes, Posts, Comentarios</h5>
                    <!-- Aquí puedes mostrar la información sobre likes, posts y comentarios -->
                </div>
            </div>

            <!-- Usuarios -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <!-- Aquí puedes mostrar información sobre usuarios registrados diarios, semanales, mensuales, etc. -->
                </div>
            </div>

            <!-- Ejercicios y Alimentos -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ejercicios y Alimentos</h5>
                    <!-- Aquí puedes mostrar información sobre ejercicios y alimentos -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Número de rutinas nuevas -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Número de rutinas nuevas</h5>
                    <!-- Aquí puedes mostrar información sobre el número de rutinas nuevas -->
                </div>
            </div>

            <!-- Ventas -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ventas</h5>
                    <!-- Aquí puedes mostrar información sobre las ventas (mensualidades) -->
                </div>
            </div>

            <!-- Gráfico de ubicación de usuarios -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Gráfico de ubicación de usuarios</h5>
                    <!-- Aquí puedes agregar tu gráfico de ubicación de usuarios con ag-charts -->
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-6">
            <!-- Gráficos -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Aqui los graficos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="likesChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="postsChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="commentsChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="newUsersChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="exercisesChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="foodsChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="newRoutinesChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="salesChart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Usuarios -->
            @include('admin.dashboard.users_dart.index')

            <!-- Gráfico de ubicación de usuarios -->
            @include('admin.dashboard.users_map.index')
            
        </div>
    </div>
</div>