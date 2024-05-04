@include('components.DeleteButtomComponent')

<script>
    const exerciseButtonComponent = new DeleteButtomComponent('exercise');

    // Configurar columnDefs
    const columnDefs = [{
            headerName: 'ID',
            field: 'id',
        },
        {
            headerName: 'Visibilidad',
            field: 'visibility',
            editable: true,
            cellEditor: "agRichSelectCellEditor",
            cellEditorParams: {
                values: ["global", "user"],
                filterList: true,
                searchType: "match",
                allowTyping: true,
                valueListMaxHeight: 220,
            }
        },
        {
            headerName: 'Creado por',
            field: 'user_id'
        },
        {
            headerName: 'Nombre',
            field: 'name',
            editable: true
        },
        {
            headerName: 'Tipo',
            field: 'type',
            editable: true,
            cellEditor: "agRichSelectCellEditor",
            cellEditorParams: {
                values: [
                    'cardio',
                    'olympic_weightlifting',
                    'plyometrics',
                    'powerlifting',
                    'strength',
                    'stretching',
                    'strongman'
                ],
                filterList: true,
                searchType: "match",
                allowTyping: true,
                valueListMaxHeight: 220,
            }
        },
        {
            headerName: 'Musculo',
            field: 'muscle',
            editable: true,
            cellEditor: "agRichSelectCellEditor",
            cellEditorParams: {
                values: [
                    'abdominals',
                    'abductors',
                    'adductors',
                    'biceps',
                    'calves',
                    'chest',
                    'forearms',
                    'glutes',
                    'hamstrings',
                    'lats',
                    'lower_back',
                    'middle_back',
                    'neck',
                    'quadriceps',
                    'traps',
                    'triceps'
                ],
                filterList: true,
                searchType: "match",
                allowTyping: true,
                valueListMaxHeight: 220,
            }
        },
        {
            headerName: 'Equipamiento',
            field: 'equipment',
            editable: true
        },
        {
            headerName: 'Dificultad',
            field: 'difficulty',
            editable: true,
            cellEditor: "agRichSelectCellEditor",
            cellEditorParams: {
                values: [
                    'beginner',
                    'intermediate',
                    'expert'
                ],
                filterList: true,
                searchType: "match",
                allowTyping: true,
                valueListMaxHeight: 220,
            }
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
        },
        {
            field: "",
            pinned: "left",
            resizable: false,
            filter: false,
            width: 45,
            cellRenderer: function(params) {
                exerciseButtonComponent.init({
                    id: params.data.id
                });
                return exerciseButtonComponent.getGui();
            },
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

    // MODAL
    $("#openModalBtn").click(function() {
        $("#addUserModal").modal('show');
    });

    $("#btnGuardarUsuario").click(function() {
        let datosAsociativos = {};
        $("#content-modal input, #content-modal select").each(function() {
            datosAsociativos[$(this).attr("id")] = $(this).val();
        });
        console.log(datosAsociativos);

        // $, ajax({
        //     url: '/user/update',
        //     type: 'PUT',
        //     data: rowEdited,
        //     success: function(response) {
        //         showAlert('success', 'Usuario editado');
        //     },
        //     error: function(xhr, status, error) {
        //         showAlert('error', 'Error al editar el usuario');
        //     }
        // })
    });
</script>
