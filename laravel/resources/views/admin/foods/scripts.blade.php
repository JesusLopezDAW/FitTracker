@include('components.DeleteButtomComponent')
<script>
    const foodButtonComponent = new DeleteButtomComponent('food');

    // Configurar columnDefs
    const columnDefs = [
        {
            field: "",
            pinned: "left",
            resizable: false,
            filter: false,
            width: 45,
            cellRenderer: function(params) {
                foodButtonComponent.init({
                    id: params.data.id
                });
                return foodButtonComponent.getGui();
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
            headerName: 'Calorias',
            field: 'calories',
            editable: true
        },
        {
            headerName: 'Grasas totales (g)',
            field: 'total_fat_g',
            editable: true
        },
        {
            headerName: 'Grasas saturadas (g)',
            field: 'saturated_fat_g',
            editable: true
        },
        {
            headerName: 'Proteína (g)',
            field: 'protein_g',
            editable: true
        },
        {
            headerName: 'Sodio (mg)',
            field: 'sodium_mg',
            editable: true
        },
        {
            headerName: 'Potasio (mg)',
            field: 'potassium_mg',
            editable: true
        },
        {
            headerName: 'Carbohidratos totales (g)',
            field: 'carbohydrate_total_g',
            editable: true
        },
        {
            headerName: 'Tamaño de la porción (g)',
            field: 'size_portion_g',
            sortable: true,
            sort: 'asc',
            editable: true
        },
        {
            headerName: 'Fibra (g)',
            field: 'fiber_g',
            editable: true
        },
        {
            headerName: 'Azúcar (g)',
            field: 'sugar_g',
            editable: true
        }
    ];


    // Div donde se renderizará la tabla
    const gridDiv = document.querySelector('#grid');
    const filterInput = document.querySelector('#filterInput');
    const usersData = {!! $foods->toJson() !!};
    console.log('Funciona')

    const gridOptions = createGrid(columnDefs, usersData, gridDiv, filterInput, "foods");
    // Cuando se edite una celda guarda la fila de la celda que se ha editado
    gridOptions.api.addEventListener('cellValueChanged', function(event) {
        const rowEdited = event.node.data;
        const csrf = getcsrf();
        rowEdited._token = csrf; // Agrega el token CSRF al objeto rowEdited

        console.log(rowEdited);
        const id = rowEdited.id;
        // Cuando se edita una celda hacemos un update de la fila a la base de datos
        $.ajax({
            url: '/food/update',
            type: 'PUT',
            data: rowEdited,
            success: function(response) {
                showAlert('success', 'Alimento editado');
            },
            error: function(xhr, status, error) {
                showAlert('error', 'Error al editar el alimento');
            }
        });
    });
</script>
