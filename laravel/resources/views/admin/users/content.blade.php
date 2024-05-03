<h1 class="text-center">Usuarios</h1>

<div class="example-wrapper">
    <div class="example-header">
        <input type="text" id="filterInput" placeholder="Filtrar por..." oninput="onFilterTextBoxChanged()" />
        <button type="button" class="btn btn-primary" id="openModalBtn">
            <i class="fas fa-user-plus"></i> Añadir Usuario
        </button>
    </div>
    <div id="grid-usuarios" class="ag-theme-quartz"></div>
</div>

@include('admin.users.modal')
