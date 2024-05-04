<?php
$routinesData = json_decode($routines);
$exercisesData = json_decode($exercises);
$foodsData = json_decode($foods);
$postsData = json_decode($posts);

// Sacar numero de likes que tiene el usuario
$postsConLikes = json_decode($likesRecibidos);

$totalLikes = 0;

foreach ($postsConLikes as $post) {
    $totalLikes += count($post->likes);
}
?>

<div class="container" style="margin-top: -24px;">
    <h1 class="text-left mt-4 mb-4" style="padding-top: 1% !important; display: flex; align-items: center;">
        <div class="image-container" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
            <img src="{{ $user->profile_photo_path }}" alt="User Image"
                style="width: 100%; height: auto; object-fit: cover;">
        </div>
        <span style="margin-left: 10px;">{{ $user->username }}</span>
    </h1>
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
                aria-controls="exercises" aria-selected="false">Ejercicios Propios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="foods-tab" data-toggle="tab" href="#foods" role="tab" aria-controls="foods"
                aria-selected="false">Alimentos Propios</a>
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
                        <li class="list-group-item"><strong>ID Usuario:</strong> {{ $user->id }}</li>
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
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Rutinas:</strong> {{ count($routines) }}</li>
                        <li class="list-group-item"><strong>Entrenamientos:</strong> {{ count($workouts) }}</li>
                        <li class="list-group-item"><strong>Ejercicios propios:</strong> {{ count($exercises) }}</li>
                        <li class="list-group-item"><strong>Aliementos propios:</strong> {{ count($foods) }}</li>
                        <li class="list-group-item"><strong>Siguiendo:</strong> {{ count($followedUsers) }}</li>
                        <li class="list-group-item"><strong>Seguidores:</strong> {{ count($followers) }}</li>
                        <li class="list-group-item"><strong>Posts:</strong> {{ count($posts) }}</li>
                        <li class="list-group-item"><strong>Comentarios:</strong> {{ count($comments) }}</li>
                        <li class="list-group-item"><strong>Likes:</strong> {{ count($likes) }}</li>
                        <li class="list-group-item"><strong>Likes Recibidos:</strong> {{ $totalLikes }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="routines" role="tabpanel" aria-labelledby="routines-tab">
            <div class="accordion" id="routineAccordion">
                @foreach ($routinesData as $routine)
                    <div class="card mb-3">
                        <div class="card-header bg-white" id="routineHeader{{ $routine->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true"
                                    aria-controls="routineCollapse{{ $routine->id }}">
                                    <span class="text-dark font-weight-bold">ID Rutina {{ $routine->id }}</span>
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
                                        {{ $routine->name }}</li>
                                    <li class="list-group-item"><strong>Tipo de Rutina:</strong> {{ $routine->type }}
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
            <div id="accordion">
                @foreach ($routinesData as $routine)
                    @foreach ($routine->workouts as $workout)
                        <div class="card mb-3">
                            <div class="card-header" id="heading{{ $workout->id }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse"
                                        data-target="#collapse{{ $workout->id }}" aria-expanded="true"
                                        aria-controls="collapse{{ $workout->id }}">
                                        <span class="text-dark font-weight-bold">{{ $workout->name }}</span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{ $workout->id }}" class="collapse"
                                aria-labelledby="heading{{ $workout->id }}" data-parent="#accordion">
                                <div class="card-body">
                                    @if (count($workout->exercise_logs) > 0)
                                        <ul class="list-group list-group-flush">
                                            @foreach ($workout->exercise_logs as $exerciseLog)
                                                <li class="list-group-item">
                                                    <div class="d-flex align-items-center">
                                                        <div class="image-container"
                                                            style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                                            <img src="{{ $exerciseLog->exercise->image }}"
                                                                alt="Exercise Image"
                                                                style="width: 100%; height: auto; object-fit: cover;">
                                                        </div>
                                                        <div class="ml-3 d-flex flex-column">
                                                            <!-- Añade un margen a la izquierda y establece flex-column para alinear verticalmente -->
                                                            <p class="mb-0">{{ $exerciseLog->exercise->name }}</p>
                                                            <div class="d-flex">
                                                                <div class="border rounded p-1 mr-2">
                                                                    <span><i class="fas fa-dumbbell"></i>
                                                                        {{ $exerciseLog->series }} sets</span>
                                                                </div>
                                                                <div class="border rounded p-1">
                                                                    <span><i class="fas fa-sync-alt"></i>
                                                                        {{ $exerciseLog->reps }} reps</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No hay ejercicios registrados para este entrenamiento.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="accordion" id="exerciseAccordion">
                @foreach ($exercisesData as $exercise)
                    <div class="card mb-3">
                        <div class="card-header bg-white" id="exerciseHeader{{ $exercise->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link d-flex align-items-center" type="button"
                                    data-toggle="collapse" data-target="#exerciseCollapse{{ $exercise->id }}"
                                    aria-expanded="true" aria-controls="exerciseCollapse{{ $exercise->id }}">
                                    <div class="image-container"
                                        style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                        <img src="{{ $exercise->image }}" alt="{{ $exercise->name }}"
                                            style="width: 100%; height: auto; object-fit: cover;">
                                    </div>
                                    <span class="text-dark font-weight-bold ml-3">{{ $exercise->name }}</span>
                                </button>
                            </h2>
                        </div>
                        <div id="exerciseCollapse{{ $exercise->id }}" class="collapse"
                            aria-labelledby="exerciseHeader{{ $exercise->id }}" data-parent="#exerciseAccordion">
                            <div class="card-body bg-light">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre del Ejercicio:</strong>
                                        {{ $exercise->name }}
                                    </li>
                                    <li class="list-group-item"><strong>Tipo de Ejercicio:</strong>
                                        {{ $exercise->type }}
                                    </li>
                                    <li class="list-group-item"><strong>Músculo:</strong> {{ $exercise->muscle }}
                                    </li>
                                    <li class="list-group-item"><strong>Equipamiento:</strong>
                                        {{ $exercise->equipment }}</li>
                                    <li class="list-group-item"><strong>Dificultad:</strong>
                                        {{ $exercise->difficulty }}</li>
                                    <li class="list-group-item"><strong>Instrucciones:</strong>
                                        {{ $exercise->instructions }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="foods" role="tabpanel" aria-labelledby="foods-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="accordion" id="foodAccordion">
                @foreach ($foodsData as $food)
                    <div class="card mb-3">
                        <div class="card-header bg-white" id="foodHeader{{ $food->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link d-flex align-items-center" type="button"
                                    data-toggle="collapse" data-target="#foodCollapse{{ $food->id }}"
                                    aria-expanded="true" aria-controls="foodCollapse{{ $food->id }}">
                                    <div class="image-container"
                                        style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                        <img src="{{ $food->image }}" alt="{{ $food->name }}"
                                            style="width: 100%; height: auto; object-fit: cover;">
                                    </div>
                                    <span class="text-dark font-weight-bold ml-3">{{ $food->name }}</span>
                                </button>
                            </h2>
                        </div>
                        <div id="foodCollapse{{ $food->id }}" class="collapse"
                            aria-labelledby="foodHeader{{ $food->id }}" data-parent="#foodAccordion">
                            <div class="card-body bg-light">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre del Alimento:</strong>
                                        {{ $food->name }}
                                    </li>
                                    <li class="list-group-item"><strong>Tamaño de la Porción (g):</strong>
                                        {{ $food->size_portion_g }}
                                    </li>
                                    <li class="list-group-item"><strong>Calorías:</strong>
                                        {{ $food->calories }} Kcal
                                    </li>
                                    <li class="list-group-item"><strong>Grasa Total (g):</strong>
                                        {{ $food->total_fat_g }}</li>
                                    <li class="list-group-item"><strong>Grasa Saturada (g):</strong>
                                        {{ $food->saturated_fat_g }}</li>
                                    <li class="list-group-item"><strong>Proteína (g):</strong>
                                        {{ $food->protein_g }}</li>
                                    <li class="list-group-item"><strong>Sodio (mg):</strong>
                                        {{ $food->sodium_mg }}</li>
                                    <li class="list-group-item"><strong>Potasio (mg):</strong>
                                        {{ $food->potassium_mg }}</li>
                                    <li class="list-group-item"><strong>Carbohidratos Totales (g):</strong>
                                        {{ $food->carbohydrate_total_g }}</li>
                                    <li class="list-group-item"><strong>Fibra (g):</strong>
                                        {{ $food->fiber_g }}</li>
                                    <li class="list-group-item"><strong>Azúcar (g):</strong>
                                        {{ $food->sugar_g }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            {{-- <p>{{ print_r($postsData) }}</p> --}}
            <div id="accordion">
                @foreach ($postsData as $post)
                    <div class="card mb-3">
                        <div class="card-header" id="heading{{ $post->id }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapse{{ $post->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $post->id }}">
                                    <span class="text-dark font-weight-bold">{{ $post->title }}</span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $post->id }}" class="collapse"
                            aria-labelledby="heading{{ $post->id }}" data-parent="#accordion">
                            <div class="card-body">
                                <div class="image-container"
                                    style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%;">
                                    <img src="{{ $post->image }}" alt="Post Image"
                                        style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                                <p class="mb-0">Nombre del Workout: {{ $post->workout->name }}</p>
                                <ul>
                                    @foreach ($post->workout->logs as $log)
                                        <li>
                                            <p class="mb-0">workout ID: {{ $workout->id }}</p>
                                            <p class="mb-0">Log ID: {{ $log->id }}</p>
                                            <p class="mb-0">Start Date: {{ $log->start_date }}</p>
                                            <p class="mb-0">End Date: {{ $log->end_date }}</p>
                                            <!-- Agrega aquí los demás campos del log que deseas mostrar -->
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div>
        <!-- Agrega más paneles según sea necesario -->
    </div>
</div>
