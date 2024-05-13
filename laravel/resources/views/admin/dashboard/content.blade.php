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
            @include('admin.dashboard.users_map.index')
            
        </div>
    </div>
</div>