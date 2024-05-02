<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">USUARIOS REGISTRADOS POR 
            <select class="form-control" id="periodo">
                <option value="day" selected>DIA</option>
                <option value="month">MES</option>
                <option value="year">AÑO</option>
            </select></h3>
        <!-- Aquí puedes mostrar información sobre usuarios registrados diarios, semanales, mensuales, etc. -->
        @include('admin.dashboard.users_dart.dart')

    </div>
</div>
