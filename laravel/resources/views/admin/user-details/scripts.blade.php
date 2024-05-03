<script>
    // Escuchar el evento de clic en el botón
    document.querySelector('.btn').addEventListener('click', function() {
        // Obtener el elemento div con la clase 'tab-pane' y el id 'workouts'
        var workoutsTab = document.querySelector('.tab-pane#workouts');

        // Verificar si el elemento existe
        if (workoutsTab) {
            // Mostrar el elemento div con la clase 'tab-pane' y el id 'workouts'
            workoutsTab.classList.add('show', 'active');
        }
    });
</script>