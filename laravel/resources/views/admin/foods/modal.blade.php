<!-- Modal agregar alimento -->
<div class="modal fade" id="addFoodModal" tabindex="-1" role="dialog" aria-labelledby="addFoodModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFoodModalLabel"><i class="fas fa-utensils"></i> Nuevo Alimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" id="content-modal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="calories">Calorías</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-fire"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="calories">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="size_portion_g">Tamaño porción (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="size_portion_g">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="total_fat_g">Grasa Total (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bacon"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="total_fat_g">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saturated_fat_g">Grasa Saturada (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bacon"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="saturated_fat_g">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="protein_g">Proteína (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-drumstick-bite"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="protein_g">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sodium_mg">Sodio (mg)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-flask"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="sodium_mg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="potassium_mg">Potasio (mg)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-flask"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="potassium_mg">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="carbohydrate_total_g">Carbohidratos (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bread-slice"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="carbohydrate_total_g">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fiber_g">Fibra (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-bread-slice"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="fiber_g">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sugar_g">Azúcar (g)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-candy-cane"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="sugar_g">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Imagen</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i>
                    Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarAlimento"><i class="fas fa-save"></i>
                    Guardar Alimento</button>
            </div>
        </div>
    </div>
</div>
