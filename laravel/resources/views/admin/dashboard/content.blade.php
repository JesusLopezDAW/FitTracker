<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-6">
            @include('admin.dashboard.widgets.content')
            @include('admin.dashboard.widgets.script')
        </div>
        <div class="col-md-6">
            <!-- Usuarios -->
            @include('admin.dashboard.users_dart.index')

            <!-- Gráfico de ubicación de usuarios -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Gráfico mapa usuarios</h5>
                    <!-- Aquí puedes agregar tu gráfico de ubicación de usuarios con AG-Grid -->
                    <div id="locationChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>