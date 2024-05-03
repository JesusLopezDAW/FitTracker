<script>
    class DeleteButtomComponent {

        constructor(entity) {
            this.entity = entity;
        }

        init(params) {
            this.eGui = document.createElement("div");
            let eButton = document.createElement("button");
            let icon = document.createElement("i");
            icon.className = "fas fa-trash"; // Clases de Font Awesome para el icono de eliminación
            eButton.appendChild(icon); // Agrega el icono como hijo del botón

            // Establece estilos para el botón
            eButton.style.padding = "0"; // Elimina el relleno del botón
            eButton.style.border = "none"; // Elimina el borde del botón
            eButton.style.backgroundColor = "transparent"; // Hace que el fondo del botón sea transparente

            // Establece estilos para el icono
            icon.style.fontSize = "16px"; // Ajusta el tamaño del icono según sea necesario

            // Agrega el evento de clic al botón
            eButton.addEventListener("click", () => this.eliminar(params.id));

            // Agrega el botón al contenedor
            this.eGui.appendChild(eButton);
        }


        getGui() {
            return this.eGui;
        }

        refresh() {
            return true;
        }

        destroy() {
            // No necesitas eliminar el eventListener aquí ya que el botón se destruirá automáticamente.
        }

        eliminar(id) {
            const csrf = getcsrf();
            console.log(`/${this.entity}/${id}`)
            Swal.fire({
                // title: "¿Quieres ver los detalles del usuario?",
                text: "¿Estás seguro de que quieres eliminar este elemento?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envía una solicitud de eliminación al servidor
                    $.ajax({
                        url: `/${this.entity}/${id}`, // URL dinámica basada en el parámetro 'entity'
                        type: 'DELETE',
                        data: {
                            _token: csrf
                        },
                        success: function(response) {
                            showAlert('success',
                                `Eliminado correctamente`
                            );
                            // const grid = document.querySelector('#grid-usuarios');
                            // console.log(grid);
                            // if (grid && grid.api) {
                            //     console.log("hola");
                            //     grid.api.refreshCells();
                            // }
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            showAlert('error', `Error al eliminar el ${this.entity}`);
                        }
                    });
                }
            });
        }


    }
</script>
