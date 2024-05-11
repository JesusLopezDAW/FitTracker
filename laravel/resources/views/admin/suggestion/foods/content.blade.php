<h1 class="text-center">Alimentos</h1>

<div class="example-wrapper">
    <div class="example-header">
        <input type="text" id="filterInput" placeholder="Filtrar por..." oninput="onFilterTextBoxChanged()" />
    </div>
    <div id="grid" class="ag-theme-quartz"></div>
</div>

@include('admin.foods.modal')