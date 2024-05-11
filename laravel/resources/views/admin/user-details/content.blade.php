<?php
    $routinesData = json_decode($routines);
    $exercisesData = json_decode($exercises);
    $foodsData = json_decode($foods);
    $postsData = json_decode($posts);
    $exercisesPostsData = json_decode($exercisesPosts);
    $postsWithLikes = json_decode($likesRecibidos);
    $commentsData = json_decode($commentsRecibidos);
    $commentsUser = json_decode($comments);

    $totalLikes = 0;
    foreach ($postsWithLikes as $post) {
        $totalLikes += count($post->likes);
    }

    $totalComments = 0;
    if (!empty($commentsData)) {
        foreach ($commentsData as $postComment) {
            $totalComments += count($postComment->comments);
        }
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
                        <li class="list-group-item"><i class="fas fa-id-card mr-2"></i><strong>ID Usuario:</strong> {{ $user->id }}</li>
                        <li class="list-group-item"><i class="fas fa-user mr-2"></i><strong>Nombre:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><i class="fas fa-user mr-2"></i><strong>Apellido:</strong> {{ $user->surname }}</li>
                        <li class="list-group-item"><i class="fas fa-user mr-2"></i><strong>Nombre de usuario:</strong> {{ $user->username }}</li>
                        <li class="list-group-item"><i class="fas fa-phone-alt mr-2"></i><strong>Teléfono:</strong> {{ $user->phone_number }}</li>
                        <li class="list-group-item"><i class="fas fa-venus-mars mr-2"></i><strong>Género:</strong> {{ $user->gender }}</li>
                        <li class="list-group-item"><i class="fas fa-birthday-cake mr-2"></i><strong>Fecha de Nacimiento:</strong> {{ $user->birthdate }}</li>
                        <li class="list-group-item"><i class="fas fa-envelope mr-2"></i><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><i class="fas fa-user-tag mr-2"></i><strong>Rol:</strong> {{ $user->rol }}</li>
                        <li class="list-group-item"><i class="fas fa-calendar-alt mr-2"></i><strong>Fecha de Creación:</strong> {{ $user->created_at }}</li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-light" id="extraDataHeading">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#extraDataCollapse"
                            aria-expanded="true" aria-controls="extraDataCollapse">
                            <i class="fas fa-info-circle mr-2"></i>Datos Extra
                        </button>
                    </h5>
                </div>
                <div id="extraDataCollapse" class="collapse" aria-labelledby="extraDataHeading">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-dumbbell mr-2"></i><strong>Rutinas:</strong> {{ count($routines) }}</li>
                            <li class="list-group-item"><i class="fas fa-running mr-2"></i><strong>Entrenamientos:</strong> {{ count($workouts) }}</li>
                            <li class="list-group-item"><i class="fas fa-dumbbell mr-2"></i><strong>Ejercicios propios:</strong> {{ count($exercises) }}</li>
                            <li class="list-group-item"><i class="fas fa-utensils mr-2"></i><strong>Aliementos propios:</strong> {{ count($foods) }}</li>
                            <li class="list-group-item"><i class="fas fa-user-friends mr-2"></i><strong>Siguiendo:</strong> {{ count($followedUsers) }}</li>
                            <li class="list-group-item"><i class="fas fa-users mr-2"></i><strong>Seguidores:</strong> {{ count($followers) }}</li>
                            <li class="list-group-item"><i class="fas fa-edit mr-2"></i><strong>Posts:</strong> {{ count($posts) }}</li>
                            <li class="list-group-item"><i class="fas fa-comment mr-2"></i><strong>Comentarios:</strong> {{ count($comments) }}</li>
                            <li class="list-group-item"><i class="fas fa-comments mr-2"></i><strong>Comentarios recibidos:</strong> {{ $totalComments }}</li>
                            <li class="list-group-item"><i class="fas fa-thumbs-up mr-2"></i><strong>Likes:</strong> {{ count($likes) }}</li>
                            <li class="list-group-item"><i class="fas fa-thumbs-up mr-2"></i><strong>Likes Recibidos:</strong> {{ $totalLikes }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="routines" role="tabpanel" aria-labelledby="routines-tab">
            <div class="accordion" id="routineAccordion">
                @if (empty($routinesData))
                    <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene rutinas.</p>
                @else
                    @foreach ($routinesData as $routine)
                        <div class="card mb-3">
                            <div class="card-header bg-white" id="routineHeader{{ $routine->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#routineCollapse{{ $routine->id }}" aria-expanded="true"
                                        aria-controls="routineCollapse{{ $routine->id }}">
                                        <span class="text-dark"><i class="fas fa-list-alt mr-2"></i>ID Rutina {{ $routine->id }}</span>
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
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="workouts" role="tabpanel" aria-labelledby="workouts-tab">
            <div id="accordion">
                @forelse ($routinesData as $routine)
                    @if (empty($routine))
                        <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene entrenamientos.</p>
                    @else
                        @foreach ($routine->workouts as $workout)
                            <div class="card mb-3">
                                <div class="card-header" id="heading{{ $workout->id }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapse{{ $workout->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $workout->id }}">
                                            <span class="text-dark"><i class="fas fa-dumbbell mr-2"></i>{{ $workout->name }}</span>
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
                    @endif
                @empty
                    <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene rutinas.</p>
                @endforelse
            </div>
        </div>
        <div class="tab-pane fade" id="exercises" role="tabpanel" aria-labelledby="exercises-tab">
            <div class="accordion" id="exerciseAccordion">
                @if (empty($exercisesData))
                    <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene ejercicios propios.</p>
                @else
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
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="foods" role="tabpanel" aria-labelledby="foods-tab">
            <div class="accordion" id="foodAccordion">
                @if (empty($foodsData))
                    <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene aliementos propios.</p>
                @else
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
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <!-- Contenido de la pestaña de ejercicios -->
            <div class="row justify-content">
                @if (empty($postsData))
                    <p style="font-size: 28px; color: #555; text-align: center; margin-top: 220px;">{{ $user->username }} no tiene posts.</p>
                @else
                    @foreach ($postsData as $post)
                        <div class="col-md-4 mb-3" id="rowsPosts">
                            <div class="card mx-2" id="card-posts">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 smaller-font">{{ $post->workout->name }}</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($post->workout->logs as $log)
                                        <!-- Duración, Volumen y Records en la misma línea con títulos -->
                                        <div style="display: flex; align-items: center; margin-right: -147px">
                                            <div style="flex: 1; display: flex; flex-direction: column;">
                                                <small>Duración</small>
                                                <span>{{ $log->duration }}</span>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column;">
                                                <small>Volumen</small>
                                                <span>{{ $log->volume }} kg</span>
                                            </div>
                                            <div style="flex: 1; display: flex; flex-direction: column;">
                                                <small>Records</small>
                                                <span>&nbsp; {{ $log->records }}<i class="fas fa-medal"></i></span>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- Div que simula las dos partes de la imagen del post -->
                                        <div class="post-image" id="{{ $log->id }}">
                                            <div class="front-image">
                                                <img src="{{ $post->image }}" alt="Post Image" class="img-fluid">
                                            </div>
                                            <div class="back-image" style="max-height: 375px; overflow-y: auto;">
                                                <ul style="margin-right: -20px; padding-right: 20px;">
                                                    @foreach ($exercisesPostsData as $exercisePost)
                                                        @if ($exercisePost->workout->id == $post->workout->id)
                                                            @foreach ($exercisePost->workout->exercise_logs as $exerciseLog)
                                                                <div class="exercise-container d-flex align-items-center mb-3" style="margin-left: -30px">
                                                                    <div class="image-container" style="width: 60px; height: 60px; overflow: hidden; border-radius: 50%; margin-right: 15px;">
                                                                        <img src="{{ $exerciseLog->exercise->image }}" alt="{{ $exerciseLog->exercise->name }}" style="width: 100%; height: auto; object-fit: cover;">
                                                                    </div>
                                                                    <div>
                                                                        @if ($exerciseLog->series == 1)
                                                                            <p class="mb-0 text-dark" style="font-size: 16px;">{{ $exerciseLog->series }} serie de {{ $exerciseLog->exercise->name }}</p>
                                                                        @else
                                                                            <p class="mb-0 text-dark" style="font-size: 16px;">{{ $exerciseLog->series }} series de {{ $exerciseLog->exercise->name }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>                                                                          
                                        </div>
                                        <div class="circles-container">
                                            <div class="circle-wrapper">
                                                <label for="circle1" class="circle"></label>
                                                <input type="checkbox" id="{{ $log->id }}circle1" class="circle-checkbox" checked />
                                            </div>
                                            <div class="circle-wrapper">
                                                <label for="circle2" class="circle"></label>
                                                <input type="checkbox" id="{{ $log->id }}circle2" class="circle-checkbox" />
                                            </div>
                                        </div>
                                        <hr>
                                        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                            <?php
                                                foreach ($postsWithLikes as $postLike) {
                                                    if ($postLike->id == $post->id) {
                                                        $numLikes = count($postLike->likes);
                                                    }
                                                }
                                            ?>
                                            <div>
                                                <small>&nbsp; &nbsp; {{$numLikes}} me gustas</small>
                                            </div>
                                            <?php
                                                foreach ($commentsData as $postComment) {
                                                    if ($postComment->id == $post->id) {
                                                        $numComments = count($postComment->comments);
                                                    }
                                                }
                                            ?>
                                            <div>
                                                <small>{{$numComments}} comentarios</small> &nbsp; &nbsp;
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            <div class="card">
                <div class="card-body">
                    @foreach ($commentsUser as $comment)
                    <div class="card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="border rounded p-1 mr-2" style="background-color: #f8f9fa;">
                                <i class="far fa-comment"></i> Comentario ID: {{ $comment->id }}
                            </div>
                            <div class="border rounded p-1 ml-2" style="background-color: #f8f9fa;">
                                <i class="far fa-sticky-note"></i> Post ID: {{ $comment->post_id }}
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <p class="card-text">Comentario: {{ $comment->content }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>        
    </div>
</div>
