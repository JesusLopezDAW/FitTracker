<script>
    class AddButtomComponent {

        constructor(entity) {
            this.entity = entity;
        }

        init(params) {
            this.eGui = document.createElement("div");
            let eButton = document.createElement("button");
            eButton.classList.add("btnEliminarRegistro");
            let icon = document.createElement("i");
            icon.className = "fas fa-plus"; // Clases de Font Awesome para el icono de eliminación
            eButton.appendChild(icon); // Agrega el icono como hijo del botón

            // Establece estilos para el botón
            eButton.style.padding = "0"; // Elimina el relleno del botón
            eButton.style.border = "none"; // Elimina el borde del botón
            eButton.style.backgroundColor = "transparent"; // Hace que el fondo del botón sea transparente

            // Establece estilos para el icono
            icon.style.fontSize = "16px"; // Ajusta el tamaño del icono según sea necesario

            // Agrega el evento de clic al botón
            eButton.addEventListener("click", () => this.add(params.id));

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

        add(id) {
            const csrf = getcsrf();
            console.log(`/${this.entity}/${id}`)
            Swal.fire({
                // title: "¿Quieres ver los detalles del usuario?",
                text: "¿Estás seguro de que quieres añadir este elemento?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Añadir"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envía una solicitud de eliminación al servidor
                    $.ajax({
                        url: `/suggestion/${this.entity}/${id}`, // URL dinámica basada en el parámetro 'entity'
                        type: 'PUT',
                        data: {
                            _token: csrf
                        },
                        success: function(response) {
                            showAlert('success',
                                `Añadido correctamente`
                            );
                            gridOptions.api.setRowData(response.data);
                        },
                        error: function(xhr, status, error) {
                            showAlert('error', `Error al añadir el ${this.entity}`);
                        }
                    });
                }
            });
        }
    }
</script>
