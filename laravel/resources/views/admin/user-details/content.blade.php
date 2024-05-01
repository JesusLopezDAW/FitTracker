<div class="container" style="margin-top: -24px;">
    <h1 class="text-left mt-4 mb-4" style="padding-top: 1% !important;">Detalles de {{ $user->name }}</h1>

    <ul class="nav nav-tabs" id="userTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#datosPersonales" role="tab"
                aria-controls="personal" aria-selected="true">Datos Personales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="routines-tab" data-toggle="tab" href="#routines" role="tab"
                aria-controls="routines" aria-selected="false">Rutinas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="workouts-tab" data-toggle="tab" href="#workouts" role="tab"
                aria-controls="workouts" aria-selected="false">Entrenamientos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="exercises-tab" data-toggle="tab" href="#exercises" role="tab"
                aria-controls="exercises" aria-selected="false">Ejercicios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="foods-tab" data-toggle="tab" href="#foods" role="tab"
                aria-controls="foods" aria-selected="false">Alimentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                aria-controls="posts" aria-selected="false">Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                aria-controls="comments" aria-selected="false">Comentarios</a>
        </li>
        <!-- Agrega más pestañas según sea necesario -->
    </ul>

    <div class="tab-content mt-4" id="userTabsContent">
        <div class="tab-pane fade show active" id="datosPersonales" role="tabpanel" aria-labelledby="personal-tab">
            <!-- Contenido de la pestaña de datos personales -->
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>Apellido:</strong> {{ $user->surname }}</li>
                        <li class="list-group-item"><strong>Nombre de usuario:</strong> {{ $user->username }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->phone_number }}</li>
                        <li class="list-group-item"><strong>Género:</strong> {{ $user->gender }}</li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $user->birthdate }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>Rol:</strong> {{ $user->rol }}</li>
                        <li class="list-group-item"><strong>Fecha de Creación:</strong> {{ $user->created_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="routines" role="tabpanel" aria-labelledby="routines-tab">
            <!-- Contenido de la pestaña de rutinas -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Rutinas del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="workouts" role="tabpanel" aria-labelledby="workouts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Entrenamientos del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Ejercicios del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="foods" role="tabpanel" aria-labelledby="foods-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Alimentos del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Posts del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Comentarios del Usuario</h2>
                    <!-- Aquí puedes mostrar las rutinas del usuario -->
                </div>
            </div>
        </div>
        <!-- Agrega más paneles según sea necesario -->
    </div>
</div>
