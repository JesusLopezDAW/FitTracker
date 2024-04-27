<script>
    // function mostrarMensaje(mensaje, tipo) {
    //     toastr.options = {
    //         "closeButton": true,
    //         "progressBar": true,
    //         "positionClass": "toast-top-right",
    //         "showDuration": "300",
    //         "hideDuration": "1000",
    //         "timeOut": "5000",
    //         "extendedTimeOut": "1000"
    //     };
    //     toastr[tipo](mensaje);
    // }

    $.ajax({
        url: '/listarUsuarios',
        type: 'GET',
        success: function(response) {
            console.log(response);
            // mostrarMensaje('¡Consulta completada!', 'success');

            // Configurar columnDefs
            const columnDefs = [{
                    headerName: 'ID',
                    field: 'id',
                    sortable: true,
                    filter: true,
                    resizable: true
                },
                {
                    headerName: 'Nombre',
                    field: 'name',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Apellido',
                    field: 'surname',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Nombre de Usuario',
                    field: 'username',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Teléfono',
                    field: 'phone_number',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Género',
                    field: 'gender',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Fecha de Nacimiento',
                    field: 'birthdate',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Correo Electrónico',
                    field: 'email',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Token',
                    field: 'token',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Rol',
                    field: 'rol',
                    sortable: true,
                    filter: true,
                    resizable: true,
                    editable: true
                },
                {
                    headerName: 'Fecha Creaccion',
                    field: 'created_at',
                    sortable: true,
                    filter: true,
                    resizable: true
                }
            ];

            const localeText = {
                // Otros textos...
                page: 'Página',
                more: 'Más',
                to: 'a',
                of: 'de',
                next: 'Siguiente',
                last: 'Último',
                first: 'Primero',
                previous: 'Anterior',
                loadingOoo: 'Cargando...',
                applyFilter: 'Aplicar filtro...',
                equals: 'Igual',
                notEqual: 'No igual',
                lessThanOrEqual: 'Menor o igual que',
                greaterThanOrEqual: 'Mayor o igual que',
                inRange: 'En rango',
                lessThan: 'Menor que',
                greaterThan: 'Mayor que',
                contains: 'Contiene',
                notContains: 'No contiene',
                startsWith: 'Empieza con',
                endsWith: 'Termina con',
                dateFormatOoo: 'yyyy-mm-dd',
                // Cambiar "Page size" a "Tamaño de página"
                pageSize: 'Tamaño de página',
            };

            // Inicializar Ag-Grid
            const gridOptions = {
                columnDefs: columnDefs,
                editable: true,
                rowData: response, // Los datos cargados desde el archivo JSON
                localeText: localeText, // Establecer el texto en español
                pagination: true, // Activar paginación
                editable: true, // Activar edicion de celdas
                paginationPageSize: 10, // Número de filas por página
                rowSelection: 'multiple', // Permitir selección de una sola fila
                rowMultiSelectWithClick: true, // Permitir selección múltiple con clic
                enableSorting: true, // Habilitar ordenación
                enableFilter: true, // Habilitar filtrado
                enableColResize: true, // Permitir cambiar el tamaño de las columnas
                suppressContextMenu: true, // Desactivar menú contextual
                suppressRowClickSelection: false, // Permitir selección de filas con clic
                animateRows: true, // Animar filas al agregar o eliminar
                enableCellTextSelection: true, // Permitir selección de texto en las celdas
                defaultColDef: {
                    resizable: true
                },
                // Enable sorting persistence
                enableSorting: true,
                // Enable filter persistence
                enableFilter: true,
                // Enable state persistence
                rememberGroupStateWhenNewData: true,
                sideBar: {
                    toolPanels: [{
                            id: 'columns',
                            labelDefault: 'Columnas',
                            labelKey: 'columns',
                            iconKey: 'columns',
                            toolPanel: 'agColumnsToolPanel'
                        },
                        {
                            id: 'customColumns',
                            labelDefault: 'Columnas Personalizadas',
                            labelKey: 'customColumns',
                            iconKey: 'columns'
                        }
                    ],
                    defaultToolPanel: 'columns'
                },
                onGridReady: function(params) {
                    // Restore column state on grid ready
                    const columnState = JSON.parse(localStorage.getItem('columnState'));
                    if (columnState) {
                        params.columnApi.applyColumnState({
                            state: columnState,
                            applyOrder: true
                        });
                    }
                },
                onColumnResized: function(params) {
                    // Guardar el estado de las columnas cuando se redimensionen
                    const columnState = params.columnApi.getColumnState();
                    localStorage.setItem('columnState', JSON.stringify(columnState));
                }
            };

            // Obtener el div donde se renderizará la tabla
            var gridDiv = document.querySelector('#grid-usuarios');

            // Crear la tabla utilizando Ag-Grid
            new agGrid.Grid(gridDiv, gridOptions);

            // Add event listener to filter input
            const filterInput = document.querySelector('#filterInput');
            filterInput.addEventListener('input', function(event) {
                gridOptions.api.setQuickFilter(filterInput.value); // Apply quick filter
            });

            // Add event listener to save column state when column order changes
            gridOptions.api.addEventListener('columnMoved', function() {
                const columnState = gridOptions.columnApi.getColumnState();
                localStorage.setItem('columnState', JSON.stringify(columnState));
            });

            // Lógica para guardar las preferencias de anclaje del usuario
            function guardarPreferenciasAnclaje(columna, posicion) {
                pinnedColumns[columna] = posicion;
                localStorage.setItem('pinnedColumns', JSON.stringify(pinnedColumns));
            }
        },
        error: function(xhr, status, error) {
            // mostrarMensaje('¡Error al consultar usuarios!', 'error');
        }
    });
</script>
