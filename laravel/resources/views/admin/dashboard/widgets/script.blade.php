<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $("#select-date-widgets").change(function() {
        const selectedValue = $(this).val();

        $.ajax({
            url: "/exercise/getExercisesByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewExercises").text(response.length + " ejercicios nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });

        $.ajax({
            url: "/food/getFoodsByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewFoods").text(response.length + " alimentos nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });

        $.ajax({
            url: "/user/getUsersByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewUsers").text(response.length + " usuarios nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });
        
        $.ajax({
            url: "/like/getLikesByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewLikes").text(response.length + " likes nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });

        $.ajax({
            url: "/post/getPostsByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewPosts").text(response.length + " posts nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });
        
        $.ajax({
            url: "/comment/getCommentsByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewComments").text(response.length + " comentarios nuevos");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });
        
        $.ajax({
            url: "/routine/getRoutinesByPeriod/" + selectedValue,
            type: "GET",
            success: function(response) {
                $("#inputNewRoutines").text(response.length + " rutinas nuevas");
            },
            error: function(xhr, status, error) {
                // console.error("Error al obtener ejercicios:", error);
            }
        });
    });
</script>
