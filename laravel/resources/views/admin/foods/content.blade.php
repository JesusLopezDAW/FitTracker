<h1 class="text-center">Alimentos</h1>

<div class="example-wrapper">
    <div class="example-header">
        <input type="text" id="filterInput" placeholder="Filtrar por..." oninput="onFilterTextBoxChanged()" />
        <button type="button" class="btn btn-primary" id="openModalBtn">
            <i class="fas fa-utensils"></i> Añadir Alimento
        </button>
    </div>
    <div id="grid" class="ag-theme-quartz"></div>
</div>

@include('admin.foods.modal')