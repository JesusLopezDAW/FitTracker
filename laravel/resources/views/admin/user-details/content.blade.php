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
            <a class="nav-link" id="foods-tab" data-toggle="tab" href="#foods" role="tab" aria-controls="foods"
                aria-selected="false">Alimentos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts"
                aria-selected="false">Posts</a>
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
            {{-- <div class="accordion" id="routineAccordion">
                @foreach ($routines as $routine)
                    <div class="card mb-3">
                        <div class="card-header bg-white" id="routineHeader{{ $routine->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true" aria-controls="routineCollapse{{ $routine->id }}">
                                    <span class="text-dark font-weight-bold">Rutina {{ $routine->id }}</span>
                                </button>
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true" aria-controls="routineCollapse{{ $routine->id }}">
                                    <span class="icon-plus"></span>
                                    <span class="icon-minus d-none"></span>
                                </button>
                            </h2>
                        </div>
                        <div id="routineCollapse{{ $routine->id }}" class="collapse" aria-labelledby="routineHeader{{ $routine->id }}" data-parent="#routineAccordion">
                            <div class="card-body bg-light">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre de Rutina:</strong> {{ $routine->name }}</li>
                                    <li class="list-group-item"><strong>Tipo de Rutina:</strong> {{ $routine->type }}</li>
                                    <!-- Agrega más detalles de la rutina según sea necesario -->
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="accordion" id="routineAccordion">
                @foreach ($routines as $routine)
                    <div class="card mb-3">
                        <div class="card-header bg-white" id="routineHeader{{ $routine->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true"
                                    aria-controls="routineCollapse{{ $routine->id }}">
                                    <span class="text-dark font-weight-bold">Rutina {{ $routine->id }}</span>
                                </button>
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true"
                                    aria-controls="routineCollapse{{ $routine->id }}">
                                    <span class="icon-plus"></span>
                                    <span class="icon-minus d-none"></span>
                                </button>
                            </h2>
                        </div>
                        <div id="routineCollapse{{ $routine->id }}" class="collapse"
                            aria-labelledby="routineHeader{{ $routine->id }}" data-parent="#routineAccordion">
                            <div class="card-body bg-light">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre de Rutina:</strong>
                                        {{ $routine->name }}
                                    </li>
                                    <li class="list-group-item"><strong>Tipo de Rutina:</strong> {{ $routine->type }}
                                    </li>
                                    <!-- Desplegable para los workouts -->
                                    <li class="list-group-item">
                                        <strong>Workouts:</strong>
                                        <button class="btn btn-link text-decoration-none" type="button"
                                            data-toggle="collapse" data-target="#workoutsCollapse{{ $routine->id }}"
                                            aria-expanded="true" aria-controls="workoutsCollapse{{ $routine->id }}">
                                            Ver Workouts
                                        </button>
                                        <div class="collapse" id="workoutsCollapse{{ $routine->id }}">
                                            <ul class="list-group mt-2">
                                                @foreach ($routine->workouts as $workout)
                                                    <li class="list-group-item">{{ $workout->name }}</li>
                                                    <!-- Agrega más detalles de los workouts si es necesario -->
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="workouts" role="tabpanel" aria-labelledby="workouts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Entrenamientos del Usuario</h2>
                    {{-- <p>{{ $workouts }}</p> --}}
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
