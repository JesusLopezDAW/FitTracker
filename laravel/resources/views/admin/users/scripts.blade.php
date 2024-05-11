@include('components.DeleteButtomComponent')

<script>
    // Configurar columnDefs
    const userButtonComponent = new DeleteButtomComponent('user');

    const columnDefs = [{
            field: "",
            pinned: "left",
            resizable: false,
            filter: false,
            width: 45,
            cellRenderer: function(params) {
                userButtonComponent.init({
                    id: params.data.id
                });
                return userButtonComponent.getGui();
            },
        },
        {
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
            cellEditor: 'agRichSelectCellEditor',
            cellEditorParams: {
                values: ['male', 'female', 'other', 'prefer_not_to_say'],
                allowTyping: true,
                filterList: true,
                highlightMatch: true,
                valueListMaxHeight: 220
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
            cellEditor: 'agRichSelectCellEditor',
            cellEditorParams: {
                values: ['user', 'admin'],
                allowTyping: true,
                filterList: true,
                highlightMatch: true,
                valueListMaxHeight: 220
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
    const usersData = {!! $users->toJson() !!};

    const gridOptions = createGrid(columnDefs, usersData, gridDiv, filterInput, "users");
    // Cuando se edite una celda guarda la fila de la celda que se ha editado
    gridOptions.api.addEventListener("cellValueChanged", function(event) {
        const rowEdited = event.node.data;
        const csrf = getcsrf();
        rowEdited._token = csrf; // Agrega el token CSRF al objeto rowEdited

        console.log(rowEdited);
        // Cuando se edita una celda hacemos un update de la fila a la base de datos
        $.ajax({
            url: '/user/update',
            type: 'PUT',
            data: rowEdited,
            success: function(response) {
                showAlert('success', 'Usuario editado');
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error al editar el usuario');
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
                    window.location.href = '/user/' + event.data.username;
                }
            });
        }
    });

    // Modal
    function getCSRFToken() {
        return $('meta[name="csrf-token"]').attr('content');
    }
    $("#openModalBtn").click(function() {
        $("#addUserModal").modal('show');
    });

    $("#btnGuardarUsuario").click(function() {
        let datosAsociativos = {};
        let camposVacios = false; 

        $("#content-modal input, #content-modal select").each(function() {
            datosAsociativos[$(this).attr("id")] = $(this).val();

            switch ($(this).attr("id")) {
                case "name":
                case "email":
                case "password":
                    if ($(this).val() === "") {
                        $(this).addClass("is-invalid");
                        camposVacios = true; 
                    }
                    break;
                default:
                    break;
            }
        });

        if (camposVacios) {
            showAlert('error', 'Por favor, completa todos los campos obligatorios.');
        } else {
            const csrf = getcsrf();
            $.ajax({
                url: '/user',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: datosAsociativos,
                success: function(response) {
                    showAlert('success', 'Usuario creado correctamente');
                },
                error: function(xhr, status, error) {
                    showAlert('error', 'Error al crear el usuario');
                }
            });
        }
    });
</script>
