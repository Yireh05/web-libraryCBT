<?php include('header.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">Sistema bibliotecario <small>Búsqueda de libro</small></h1>
            </div>

            <div class="container-fluid" style="margin: 40px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="assets/img/introduccion.png" alt="pdf" class="img-responsive center-box" style="max-width: 200px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        ¡Bienvenido a la sección de búsqueda!
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                        A continuación elige la opción por la que deseas realizar tu búsqueda
                    </div>
                </div>
            </div>
            <form action="buscar.php" method="POST" class="text-center" style="margin: 50px 0;">
                <label for="criterio">Desea buscar mediante:</label>
                <select name="criterio" class="form-control" style="width: 150px; display: inline-block;">
                    <option value="titulo">Título</option>
                    <option value="autor">Autor</option>
                    <option value="editorial">Editorial</option>
                    <option value="categoria">Categoría</option>
                </select>
                <input type="text" name="valor" placeholder="Ingrese el título, autor, editorial o categoría" required class="form-control" style="width: 300px; display: inline-block;">
                <button type="submit" class="btn btn-success">Buscar</button>
            </form>
        
            <?php include('footer.php'); ?>
</body>
</html>


