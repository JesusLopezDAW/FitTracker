<style>
    .user-details {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .user-details h2 {
        margin-bottom: 10px;
    }

    .user-details ul {
        list-style: none;
        padding: 0;
    }

    .user-details li {
        margin-bottom: 10px;
    }

    .user-details li strong {
        display: inline-block;
        width: 150px;
    }


    /* Estilos para la imagen del posts */
    .post-image {
        width: auto;
        /* Ancho fijo */
        height: 400px;
        /* Alto fijo */
        position: relative;
        overflow: hidden;
    }

    .post-image img {
        width: 100%;
        /* Para que la imagen se ajuste al tamaño del contenedor */
        height: auto;
    }

    .front-image {
        position: absolute;
        top: 0;
        left: 0;
        transition: transform 0.5s ease;
        /* Agregar transición solo a la imagen principal */
        z-index: 2;
        /* Asegurar que la imagen frontal esté sobre la imagen trasera */
    }

    .back-image {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        /* Asegurar que la imagen trasera esté detrás de la imagen frontal */
    }

    .fas.fa-medal {
        color: orange;
    }

    /* Circulos al cambiar de imagen en el post */
    .circles-container {
        display: flex;
        justify-content: center;
        position: absolute;
        bottom: 5px;
        /* Ajusta la posición vertical según lo necesites */
        left: 0;
        right: 0;
    }

    .circle-wrapper {
        margin-right: 4px;
        /* Espacio entre los checkboxes */
    }

    .circle-checkbox {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        border: none;
        background-color: rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease-in-out;
    }

    .circle-checkbox:checked {
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
