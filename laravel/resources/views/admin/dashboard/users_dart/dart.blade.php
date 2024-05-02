<div id="myGrid" style="height: 20%;width: 100%;" class="ag-theme-alpine"></div>
<!-- Contenedor para el gráfico Highcharts -->
<canvas id="graficaUsuariosRegistrados" width="400" height="200"></canvas>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Realizar una solicitud AJAX para obtener los datos de usuarios registrados por día
        fetch('/api/users_registered_per_day')
            .then(response => response.json())
            .then(data => {
                // Una vez que se reciban los datos, configurar y mostrar el gráfico
                configurarYMostrarGrafica(data);
            })
            .catch(error => console.error('Error al obtener los datos:', error));
    });
    document.getElementById('periodo').addEventListener('change', function() {
        const periodo = this.value;
        fetch('/api/users_registered_per_' + periodo)
            .then(response => response.json())
            .then(data => {
                configurarYMostrarGrafica(data);
            })
            .catch(error => {
                console.error('Error al obtener los datos:', error);
            });
    });

    function configurarYMostrarGrafica(data) {
        const fechas = data.map(item => item.date);
        const usuariosRegistrados = data.map(item => item.users);

        const ctx = document.getElementById('graficaUsuariosRegistrados').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: fechas,
                datasets: [{
                    label: 'Usuarios Registrados',
                    data: usuariosRegistrados,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Usuarios Registrados'
                        }
                    }
                }
            }
        });
    }
</script>
