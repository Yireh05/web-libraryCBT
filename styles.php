<style>
        .navbar-user-top ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
        }
        .navbar-user-top ul li {
            margin-left: 15px;
        }
        .navbar-user-top ul li a {
            text-decoration: none;
            color: #000;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar-user-top ul li a:hover {
           background-color: #B9E681;
        }
        .table th, .table td {
           vertical-align: middle;
        }
        /* Estilos para la paginación */
        .pagination-container {
           background-color: #f0f0f0; /* Gris claro de fondo */
           border-radius: 5px; /* Opcional: para bordes redondeados */
           padding: 10px;
           text-align: center;
        }

        .pagination li {
          display: inline-block;
          margin: 0 5px;
        }

        .pagination li a {
           color: #555; /* Gris oscuro para el texto */
           text-decoration: none;
           padding: 5px 10px;
           border: 1px solid #ddd; /* Borde gris claro */
           border-radius: 3px;
           transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination li a:hover {
           background-color: #ccc; /* Gris más oscuro al pasar el mouse */
           color: white;
        }

        .pagination li.active a {
           background-color: #999; /* Gris medio para el número de página activo */
           color: white;
        }

        .pagination li a:focus {
           outline: none;
           box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        }
    </style>