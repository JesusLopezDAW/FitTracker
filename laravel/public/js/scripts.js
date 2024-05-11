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
// Ejemplo -> const gridOptions = createGrid(columnDefs, json, gridDiv, filterInput, "tableName");
window.createGrid = function name(columnDefs, json, gridDiv, filterInput, tableName) {

    // Traducciones al español
    const localeText = {
        // Textos generales
        page: "Pagina",
        more: "Mas",
        to: "a",
        of: "de",
        next: "Siguiente",
        last: "Ultimo",
        first: "Primero",
        previous: "anterior",
        loadingOoo: "Cargando...",
        selectAll: "Seleccionar todo",
        searchOoo: "Buscar...",
        blanks: "Espacio en blanco",
        filterOoo: "Filtrar...",
        applyFilter: "Aplicar filtro...",
        equals: "es igual a",
        notEqual: "no es igual a",
        lessThan: "menor que",
        greaterThan: "mayor que",
        lessThanOrEqual: "menor o igual que",
        greaterThanOrEqual: "mayor o igual que",
        inRange: "en el rango",
        contains: "contiene",
        notContains: "no contiene",
        startsWith: "empieza con",
        endsWith: "acaba con",
        group: "Grupo",
        columns: "Columnas",
        filters: "Filtros",
        rowGroupColumns: "Arrastra la columna para pivotar",
        rowGroupColumnsEmptyMessage: "Arrastra la columna para grupo",
        valueColumns: "Valor de las columnas",
        pivotMode: "Modo pivot",
        groups: "Grupos",
        values: "Valores",
        pivots: "Pivots",
        valueColumnsEmptyMessage: "Arrastra para columnas",
        pivotColumnsEmptyMessage: "Arrastra para pivotar",
        toolPanelButton: "Panel de herramientas",
        noRowsToShow: "Sin datos",
        pinColumn: "Pin columna",
        valueAggregation: "Agregación de valor",
        autosizeThiscolumn: "Tamaño automático esta columna",
        autosizeAllColumns: "Tamaño automático todas las columnas",
        groupBy: "Agrupar por",
        ungroupBy: "Desagrupar por",
        resetColumns: "Resetear columnas",
        expandAll: "Expandir todo",
        collapseAll: "Colapsar todo",
        toolPanel: "Panel de herramientas",
        export: "Exportar",
        csvExport: "Exportar a CSV",
        excelExport: "Exportar a Excel",
        pinLeft: "Pin izquierda",
        pinRight: "Pin derecha",
        noPin: "Sin pin",
        sum: "Suma",
        min: "Minimo",
        max: "Maximo",
        none: "Ninguno",
        count: "Cuenta",
        average: "Promedio",
        copy: "Copiar",
        copyWithHeaders: "Copiar con cabeceras",
        ctrlC: "Ctrl + C",
        paste: "Pegar",
        ctrlV: "Ctrl + V",
        searchOoo: 'Buscar...',
        pageSize: 'Tamaño de página',
        // Textos adicionales de filtros (para fechas)
        dateFormatOoo: 'yyyy-mm-dd',
        // Otros textos de filtros...
    };

    // Inicializar Ag-Grid y configuracion
    const gridOptions = {
        columnDefs: columnDefs, // Columnas que muestra
        rowData: json, // Los datos cargados desde el archivo JSON
        localeText: localeText, // Establecer el texto en español
        pagination: true, // Activar paginación
        paginationPageSize: 20, // Número de filas por página
        rowSelection: 'multiple', // Permitir selección de multiples filas control + click
        suppressRowClickSelection: false, // Permitir selección de filas con clic
        animateRows: true, // Animar filas al agregar o eliminar
        enableCellTextSelection: true, // Permitir selección de texto en las celdas
        defaultColDef: {
            resizable: true,
            sortable: true,
            filter: true,
            enableRowGroup: true,
            enableGroup: true
        },
        rowGroupPanelShow: 'always',
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
        },
        onColumnMoved: function (params) {
            // Guardar el estado de las columnas cuando se muevan
            const columnState = params.api.getColumnState();
            localStorage.setItem(`columnState${tableName}`, JSON.stringify(columnState));
        },
        onColumnPinned: function (params) {
            // Guardar el estado de las columnas cuando se pin o despin
            const columnState = params.api.getColumnState();
            localStorage.setItem(`columnState${tableName}`, JSON.stringify(columnState));
        },
        sideBar: {
            toolPanels: [
                {
                    id: 'columns',
                    labelDefault: 'Columnas',
                    labelKey: 'columns',
                    iconKey: 'columns',
                    toolPanel: 'agColumnsToolPanel',
                    toolPanelParams: {
                        suppressPivots: true,
                        suppressPivotMode: true,
                        suppressValues: true
                    }
                },
                {
                    id: 'filters',
                    labelDefault: 'Filtros',
                    labelKey: 'filters',
                    iconKey: 'filter',
                    toolPanel: 'agFiltersToolPanel'
                }
            ],
            defaultToolPanel: true // Activar agrupación en la barra lateral
        },
        toolPanelParams: {
            suppressPivots: true,
            suppressPivotMode: true,
            suppressValues: true,
            suppressRowGroups: true, 
            suppressColumns: false,
            suppressFilters: false,
            suppressValues: false,
            enableGroup: true // Habilita la agrupación en la barra lateral
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

