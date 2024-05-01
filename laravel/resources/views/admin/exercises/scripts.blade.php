<script>
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
            headerName: 'Tipo',
            field: 'type',
            editable: true
        },
        {
            headerName: 'Musculo',
            field: 'muscle',
            editable: true
        },
        {
            headerName: 'Equipamiento',
            field: 'equipment',
            editable: true
        },
        {
            headerName: 'Dificultad',
            field: 'difficulty',
            editable: true
        },
        {
            headerName: 'Instrucciones',
            field: 'instructions',
            editable: true,
            cellEditor: 'agLargeTextCellEditor',
            cellEditorPopup: true,
            cellEditorParams: {
                maxLength: 100
            }
        }
    ];

    // Div donde se renderizará la tabla
    const gridDiv = document.querySelector('#grid-exercises');
    const filterInput = document.querySelector('#filterInput');
    const usersData = {!! $exercises->toJson() !!};

    const gridOptions = createGrid(columnDefs, usersData, gridDiv, filterInput, "exercises");
    // Cuando se edite una celda guarda la fila de la celda que se ha editado
    gridOptions.api.addEventListener("cellValueChanged", function(event) {
        const rowEdited = event.node.data;
        const csrf = getcsrf();
        rowEdited._token = csrf; // Agrega el token CSRF al objeto rowEdited

        console.log(rowEdited);
        // Cuando se edita una celda hacemos un update de la fila a la base de datos
        $.ajax({
            url: '/exercise/update',
            type: 'PUT',
            data: rowEdited,
            success: function(response) {
                showAlert('success', 'Ejercicio editado');
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error al editar el ejercicio');
            }
        });
    });

    gridOptions.api.addEventListener('cellDoubleClicked', function(event) {
        // Verificar si la celda doble clic se encuentra en la columna "ID"
        if (event.column.getColDef().field === 'id') {
            Swal.fire({
                // title: "¿Quieres ver los detalles del usuario?",
                text: "¿Quieres ver los detalles del usuario?",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ver detalles"
            }).then((result) => {
                if (result.isConfirmed) {
                    const userName = event.data.name;
                    // Redirigir al usuario a la URL para ver los detalles del usuario por su ID
                    window.location.href = `/user/${userName}`;
                }
            });
        }
    });
</script>
