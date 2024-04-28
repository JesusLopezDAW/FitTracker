<script>
    $.ajax({
        url: '/listarUsuarios',
        type: 'GET',
        success: function(json) {

            // Configurar columnDefs
            const columnDefs = [{
                    headerName: 'ID',
                    field: 'id',
                },
                {
                    headerName: 'Nombre',
                    field: 'name',
                    editable: true
                },
                {
                    headerName: 'Apellido',
                    field: 'surname',
                    editable: true
                },
                {
                    headerName: 'Nombre de Usuario',
                    field: 'username',
                    editable: true
                },
                {
                    headerName: 'Teléfono',
                    field: 'phone_number',
                    editable: true,
                    cellEditor: 'agNumberCellEditor',
                    cellEditorParams: {
                        min: 1,
                        max: 999999999
                    }

                },
                {
                    headerName: 'Género',
                    field: 'gender',
                    editable: true,
                    cellEditor: 'agSelectCellEditor',
                    cellEditorParams: {
                        values: ['male', 'female', 'other', 'prefer_not_to_say']
                    }
                },
                {
                    headerName: 'Fecha de Nacimiento',
                    field: 'birthdate',
                    editable: true,
                    cellEditor: 'agDateCellEditor',
                    cellEditorParams: {
                        min: '1920-01-01'
                    }
                },
                {
                    headerName: 'Correo Electrónico',
                    field: 'email',
                    editable: true
                },
                {
                    headerName: 'Token',
                    field: 'token',
                },
                {
                    headerName: 'Rol',
                    field: 'rol',
                    editable: true,
                    cellEditor: 'agSelectCellEditor',
                    cellEditorParams: {
                        values: ['user', 'admin']
                    }
                },
                {
                    headerName: 'Fecha Creaccion',
                    field: 'created_at',
                }
            ];

            // Div donde se renderizará la tabla
            const gridDiv = document.querySelector('#grid-usuarios');
            const filterInput = document.querySelector('#filterInput');

            const gridOptions = createGrid(columnDefs, json, gridDiv, filterInput);

            // Cuando se edite una celda guarda la fila de la celda que se ha editado
            gridOptions.onCellValueChanged = function(event) {
                const rowEdited = event.node.data;
                const csrf = getcsrf();
                rowEdited._token = csrf; // Agrega el token CSRF al objeto rowEdited

                console.log(rowEdited);
                // Cuando se edita una celda hacemos un update de la fila a la base de datos
                $.ajax({
                    url: '/UpdateUsuario',
                    type: 'POST',
                    data: rowEdited,
                    success: function(response) {
                        showAlert('success', "Usuario editado");
                    },
                    error: function(xhr, status, error) {
                        showAlert('error','Error al editar el usuario');
                    }
                });
            };

        },
        error: function(xhr, status, error) {
            showAlert('error','Error al listar los usuarios');
        }
    });
</script>
