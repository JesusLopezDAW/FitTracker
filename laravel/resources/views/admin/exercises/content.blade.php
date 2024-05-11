<h1 class="text-center">Ejercicios</h1>

<div class="example-wrapper">
    <div class="example-header">
        <input type="text" id="filterInput" placeholder="Filtrar por..." oninput="onFilterTextBoxChanged()" />
        <button type="button" class="btn btn-primary" id="openModalBtn">
            <i class="fas fa-dumbbell"></i> Añadir Ejercicio
        </button>
    </div>
    <div id="grid-exercises" class="ag-theme-quartz"></div>
</div>

@include('admin.exercises.modal')