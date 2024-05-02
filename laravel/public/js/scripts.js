// // Alertas de SweetAlert2
// // Ejemplo -> showAlert('success', "Usuario editado");
const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 1500
});
window.showAlert = function (icon, title) {
    Toast.fire({
        icon: icon,
        title: title
    })
}

// Crear tabla con AG-GRID
// Los parametros que hay que pasarle son:
// columnDefs -> Definicion de las columnas
// json -> JSON del cual va a coger los datos para la tabla
// gridDiv -> ID del div donde va a estar la tabla
// filterInput -> ID del input para el buscador
// tableName -> Nombre de la tabla
// Ejemplo -> const gridOptions = createGrid(columnDefs, json, gridDiv, filterInput);
window.createGrid = function name(columnDefs, json, gridDiv, filterInput, tableName) {
    // console.log(json)

    // Ejemplo de configurar columnDefs (Esto debes pasarselo en la funcion, es solo un ejemplo)
    // const columnDefs = [{
    //     headerName: 'ID',
    //     field: 'id',
    // },
    // {
    //     headerName: 'Nombre',
    //     field: 'name',
    //     editable: true
    // },
    // {
    //     headerName: 'Apellido',
    //     field: 'surname',
    //     editable: true
    // },
    // {
    //     headerName: 'Nombre de Usuario',
    //     field: 'username',
    //     editable: true
    // },
    // {
    //     headerName: 'Teléfono',
    //     field: 'phone_number',
    //     editable: true,
    //     cellEditor: 'agNumberCellEditor',
    //     cellEditorParams: {
    //         min: 1,
    //         max: 999999999
    //     }

    // },
    // {
    //     headerName: 'Género',
    //     field: 'gender',
    //     editable: true,
    //     cellEditor: 'agSelectCellEditor',
    //     cellEditorParams: {
    //         values: ['male', 'female', 'other', 'prefer_not_to_say']
    //     }
    // },
    // {
    //     headerName: 'Fecha de Nacimiento',
    //     field: 'birthdate',
    //     editable: true,
    //     cellEditor: 'agDateCellEditor',
    //     cellEditorParams: {
    //         min: '1920-01-01'
    //     }
    // },
    // {
    //     headerName: 'Correo Electrónico',
    //     field: 'email',
    //     editable: true
    // },
    // {
    //     headerName: 'Token',
    //     field: 'token',
    // },
    // {
    //     headerName: 'Rol',
    //     field: 'rol',
    //     editable: true,
    //     cellEditor: 'agSelectCellEditor',
    //     cellEditorParams: {
    //         values: ['user', 'admin']
    //     }
    // },
    // {
    //     headerName: 'Fecha Creaccion',
    //     field: 'created_at',
    // }
    // ];

    // Traducciones al español
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
        pageSize: 'Tamaño de página',
    };

    // Inicializar Ag-Grid y configuracion
    const gridOptions = {
        columnDefs: columnDefs, // Columnas que muestra
        rowData: json, // Los datos cargados desde el archivo JSON
        localeText: localeText, // Establecer el texto en español
        pagination: true, // Activar paginación
        paginationPageSize: 20, // Número de filas por página
        rowSelection: 'multiple', // Permitir selección de multiples filas control + click
        suppressContextMenu: true, // Desactivar menú contextual
        suppressRowClickSelection: false, // Permitir selección de filas con clic
        animateRows: true, // Animar filas al agregar o eliminar
        enableCellTextSelection: true, // Permitir selección de texto en las celdas
        defaultColDef: {
            resizable: true,
            sortable: true,
            filter: true
        },
        // Cuando carga la tabla
        onGridReady: function (params) {
            // Recupera el estado de las columnas
            const columnState = JSON.parse(localStorage.getItem(`columnState${tableName}`));
            if (columnState) {
                params.api.applyColumnState({
                    state: columnState,
                    applyOrder: true
                });
            }
        },
        // Cuando cambias el tamaño de una columna
        onColumnResized: function (params) {
            // Guardar el estado de las columnas cuando se redimensionen
            const columnState = params.api.getColumnState();
            localStorage.setItem(`columnState${tableName}`, JSON.stringify(columnState));
        }
    };

    // Crear la cuadrícula utilizando Ag-Grid
    new agGrid.Grid(gridDiv, gridOptions);

    // Evento para el buscador de la tabla
    filterInput.addEventListener('input', function (event) {
        gridOptions.api.setQuickFilter(filterInput.value);
    });

    // Cuando mueves una columna guarda el estado de las columnas
    gridOptions.api.addEventListener('columnMoved', function () {
        const columnState = gridOptions.api.getColumnState();
        localStorage.setItem(`columnState${tableName}`, JSON.stringify(columnState));
    });
    
    return gridOptions;
}

// CSRF Token 
window.getcsrf = function () {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

