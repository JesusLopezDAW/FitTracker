<!-- Modal agregar usuario-->
<div class="modal fade" id="addExerciseModal" tabindex="-1" role="dialog" aria-labelledby="addExerciseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExerciseModalLabel"><i class="fas fa-user-plus"></i> Nuevo Ejercicio
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" id="content-modal">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Nombre</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Tipo</label>
                                <select class="form-control" name="type">
                                    <option value="cardio">Cardio</option>
                                    <option value="olympic_weightlifting">Olympic Weightlifting</option>
                                    <option value="plyometrics">Plyometrics</option>
                                    <option value="powerlifting">Powerlifting</option>
                                    <option value="strength">Strength</option>
                                    <option value="stretching">Stretching</option>
                                    <option value="strongman">Strongman</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username"> Musculo</label>
                                <select class="form-control" name="muscle">
                                    <option value="abdominals">Abdominals</option>
                                    <option value="abductors">Abductors</option>
                                    <option value="adductors">Adductors</option>
                                    <option value="biceps">Biceps</option>
                                    <option value="calves">Calves</option>
                                    <option value="chest">Chest</option>
                                    <option value="forearms">Forearms</option>
                                    <option value="glutes">Glutes</option>
                                    <option value="hamstrings">Hamstrings</option>
                                    <option value="lats">Lats</option>
                                    <option value="lower_back">Lower Back</option>
                                    <option value="middle_back">Middle Back</option>
                                    <option value="neck">Neck</option>
                                    <option value="quadriceps">Quadriceps</option>
                                    <option value="traps">Traps</option>
                                    <option value="triceps">Triceps</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthdate"><i class="fas fa-calendar-alt"></i> Instrucciones</label>
                                <input type="text" class="form-control" id="instructions">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol"><i class="fas fa-dumbbell"></i> Equipamiento</label>
                                <input type="text" class="form-control" id="eqipment">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number"> Dificultad</label>
                                <select class="form-control" id="difficulty">
                                    <option value="beginner">Principiante</option>
                                    <option value="intermediate">Intermedio</option>
                                    <option value="expert">Avanzado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><i class="fas fa-image"></i> Imagen</label>
                                <input type="file" id="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender"><i class="fas fa-video"></i> Video</label>
                                <input type="file" id="video">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarEjercicio"><i class="fas fa-save"></i>
                    Guardar Ejercicio</button>
            </div>
        </div>
    </div>
</div>
