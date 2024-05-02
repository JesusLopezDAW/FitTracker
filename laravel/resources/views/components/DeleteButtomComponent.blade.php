<script>
    class DeleteButtomComponent {

        constructor(entity) {
            this.entity = entity;
        }

        init(params) {
            this.eGui = document.createElement("div");
            let eButton = document.createElement("button");
            eButton.className = "btn-danger";
            eButton.textContent = "ELIMINAR";
            eButton.addEventListener("click", () => this.eliminar(params.id));
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
            const confirmation = confirm("¿Estás seguro de que quieres eliminar este elemento?");
            if (confirmation) {
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
                        setTimeout(() => {
                            location.reload()
                        }, 2000);

                    },
                    error: function(xhr, status, error) {
                        showAlert('error', `Error al eliminar el ${this.entity}`);
                    }
                });
            }
        }


    }
</script>
