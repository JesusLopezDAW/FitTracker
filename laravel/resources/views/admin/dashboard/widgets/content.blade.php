<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Seleccionar Período </h5>
        <select class="form-select mb-3" id="select-date-widgets">
            <option value="hoy">Hoy</option>
            <option value="ultima_semana">Última Semana</option>
            <option value="ultimo_mes">Último Mes</option>
            <option value="ultimos_3_meses">Últimos 3 Meses</option>
            <option value="ultimos_6_meses">Últimos 6 Meses</option>
            <option value="ultimo_ano">Último Año</option>
            <option value="global">Global</option>
        </select>
        <!-- Gráficos -->
        <div class="row">
            <!-- Widget 1 - Likes -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="far fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number" id="inputNewLikes">10,000</span>
                    </div>
                </div>
            </div>
            <!-- Widget 2 - Post -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-success elevation-1"><i class="far fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Posts</span>
                        <span class="info-box-number" id="inputNewPosts">500</span>
                    </div>
                </div>
            </div>
            <!-- Widget 3 - Comentarios -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-warning elevation-1"><i class="far fa-comment"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Comentarios</span>
                        <span class="info-box-number" id="inputNewComments">1,200</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widget 4 - Usuarios -->
        <div class="row">
            <!-- Widget 4 - Usuarios -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios</span>
                        <span class="info-box-number" id="inputNewUsers">5,000</span>
                    </div>
                </div>
            </div>
            <!-- Widget 5 - Ejercicios -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-dumbbell"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ejercicios</span>
                        <span class="info-box-number" id="inputNewExercises">800</span>
                    </div>
                </div>
            </div>
            <!-- Widget 6 - Alimentos -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-apple-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Alimentos</span>
                        <span class="info-box-number" id="inputNewFoods">300</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widget 7 - Numero de Rutinas Nuevas -->
        <div class="row">
            <!-- Widget 7 - Numero de Rutinas Nuevas -->
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-primary elevation-1"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rutinas Nuevas</span>
                        <span class="info-box-number" id="inputNewRoutines">50</span>
                    </div>
                </div>
            </div>
            <!-- Widget 8 - Ventas -->
            {{-- <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventas</span>
                        <span class="info-box-number">200</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>