@include('components.DeleteButtomComponent')
@include('components.AddButtomComponent')

<script>
    const exerciseButtonComponent = new DeleteButtomComponent('exercise');
    const addButtonComponent = new AddButtomComponent('exercise');
    console.log('ola')
    // Configurar columnDefs
    const columnDefs = [
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
        },
        {
            field: "",
            pinned: "left",
            resizable: false,
            filter: false,
            width: 45,
            cellRenderer: function(params) {
                addButtonComponent.init({
                    id: params.data.id
                });
                return addButtonComponent.getGui();
            },
        },
        {
            headerName: 'ID',
            field: 'id',
        },
        {
            headerName: 'Visibilidad',
            field: 'visibility',
            pinned: "right",
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
        }
        
    ];

    // Div donde se renderizará la tabla
    const gridDiv = document.querySelector('#grid-exercises');
    const filterInput = document.querySelector('#filterInput');
    const usersData = {!! $exercises->toJson() !!};

    const gridOptions = createGrid(columnDefs, usersData, gridDiv, filterInput, "exercises");
    // Cuando se edite una celda guarda la fila de la celda que se ha editado
    // gridOptions.api.addEventListener("cellValueChanged", function(event) {
    //     const rowEdited = event.node.data;
    //     const csrf = getcsrf();
    //     rowEdited._token = csrf; // Agrega el token CSRF al objeto rowEdited

    //     console.log(rowEdited);
    //     // Cuando se edita una celda hacemos un update de la fila a la base de datos
    //     $.ajax({
    //         url: '/exercise/update',
    //         type: 'PUT',
    //         data: rowEdited,
    //         success: function(response) {
    //             showAlert('success', 'Ejercicio editado');
    //         },
    //         error: function(xhr, status, error) {
    //             showAlert('error', 'Error al editar el ejercicio');
    //         }
    //     });
    // });

    
</script>
