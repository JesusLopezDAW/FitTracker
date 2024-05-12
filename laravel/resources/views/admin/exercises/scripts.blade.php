@include('components.DeleteButtomComponent')

<script>
    const exerciseButtonComponent = new DeleteButtomComponent('exercise');

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

    const gridDiv = document.querySelector('#grid-exercises');
    const filterInput = document.querySelector('#filterInput');
    const usersData = {!! $exercises->toJson() !!};

    const gridOptions = createGrid(columnDefs, usersData, gridDiv, filterInput, "exercises");

    gridOptions.api.addEventListener("cellValueChanged", function(event) {
        const rowEdited = event.node.data;
        const csrf = getcsrf();
        rowEdited._token = csrf;

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

    $("#openModalBtn").click(function() {
        $("#addExerciseModal").modal('show');
    });

    $("#btnGuardarEjercicio").click(function() {
        let formData = new FormData();
        let camposVacios = false;

        $("#content-modal input, #content-modal select").each(function() {
            if ($(this).attr("id") != "image" && $(this).attr("id") != "video") {
                formData.append($(this).attr("id"), $(this).val());
            }

            switch ($(this).attr("id")) {
                case "name":
                case "type":
                case "muscle":
                case "difficulty":
                case "instructions":
                    if ($(this).val() === "") {
                        $(this).addClass("is-invalid");
                        camposVacios = true;
                    }
                    break;
                default:
                    break;
            }
        });

        let imageFile = $("#image")[0].files[0];
        let videoFile = $("#video")[0].files[0];

        formData.append('image', imageFile);
        formData.append('video', videoFile);

        if (camposVacios) {
            showAlert('error', 'Por favor, completa todos los campos obligatorios.');
        } else {
            const csrf = getcsrf();
            $.ajax({
                url: '/exercise',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showAlert('success', 'Ejercicio creado correctamente');
                    $("#addExerciseModal").modal('hide');
                },
                error: function(xhr, status, error) {
                    showAlert('error', 'Error al crear el ejercicio');
                }
            });
        }
    });
</script>
