<?php
$routinesData = json_decode($routines);
?>

<div class="container" style="margin-top: -24px;">
    <h1 class="text-left mt-4 mb-4" style="padding-top: 1% !important;">
        <img src="{{ $user->profile_photo_path }}" alt="User Image" class="mr-3 rounded-circle" style="max-width: 100px;">
        {{ $user->name }}
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
                                    <ul class="list-group list-group-flush">
                                        @foreach ($workout->exercise_logs as $exerciseLog)
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $exerciseLog->exercise->image }}"
                                                        alt="Exercise Image" class="mr-3 rounded-circle"
                                                        style="max-width: 100px;">
                                                    <div>
                                                        <p class="mb-0">{{ $exerciseLog->exercise->name }}</p>
                                                        <br>
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="foods" role="tabpanel" aria-labelledby="foods-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="card">
                <div class="card-body">
                </div>
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
