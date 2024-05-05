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

    // function toggleImage() {
    //     document.querySelector('.post-image').classList.toggle('open');
    // }

    $(".post-image").click(function() {
        // Obtener el ID del div post-image clicado
        const id = $(this).attr('id');
        console.log(id);

        // Seleccionar la imagen frontal
        const frontImage = $("#" + id + " .front-image");

        // Comprobar si la imagen frontal está visible
        if (frontImage.css('marginLeft') === '0px') {
            // Si la imagen frontal está visible, desplazarla hacia la izquierda para revelar la imagen trasera y los ejercicios
            frontImage.animate({
                marginLeft: '-115%'
            }, 500);
            $("#"+id+"circle2").prop("checked", true);
            $("#"+id+"circle1").prop("checked", false);
        } else {
            // Si la imagen frontal no está visible, devolverla a su posición original
            frontImage.animate({
                marginLeft: '0'
            }, 500);
            $("#"+id+"circle1").prop("checked", true);
            $("#"+id+"circle2").prop("checked", false);
        }
    });
</script>
