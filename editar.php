<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al formulario de login si no está autenticado
    header("Location: login.php");
    exit();
}

// Aquí va el resto del código para editar el libro
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Libro</title>
</head>
<body>
    <h2>Editar Libro</h2>
    <!-- Contenido de la página de edición -->
    
    <!-- Enlace para cerrar sesión -->
     
    <a href="logout.php"><button type='button' class='btn btn-outline-light'>Salir</button></a>
    
</body>
</html>

<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Búsqueda
    if (isset($_POST['criterio']) && isset($_POST['valor'])) {
        $criterio = $_POST['criterio'];
        $valor = $_POST['valor'];

        if (in_array($criterio, ['titulo', 'autor', 'editorial', 'categoria'])) {
            $sql = "SELECT * FROM libros WHERE $criterio LIKE :valor";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':valor', '%' . $valor . '%', PDO::PARAM_STR);
            $stmt->execute();

            // Verificar si hay resultados
            if ($stmt->rowCount() > 0) {
                $resultados = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $resultados[] = $row;
                }
            } else {
                $no_resultado = true;
            }
        } else {
            $error = "Criterio de búsqueda no válido.";
        }
    }

    // Edición
    if (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $editorial = $_POST['editorial'];
        $categoria = $_POST['categoria'];
        $estado = $_POST['estado'];

        // Actualizar datos en la base de datos
        $sql = "UPDATE libros SET titulo = :titulo, autor = :autor, editorial = :editorial, categoria = :categoria, estado = :estado WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':autor', $autor, PDO::PARAM_STR);
        $stmt->bindValue(':editorial', $editorial, PDO::PARAM_STR);
        $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $exito = "El libro ha sido actualizado correctamente.";
    }
} elseif (isset($_GET['editar_id'])) {
    // Si estamos editando un libro, obtenemos los datos para mostrar en el formulario
    $id = $_GET['editar_id'];
    $sql = "SELECT * FROM libros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include('header.php'); ?>
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
        .form-container {
            margin-top: 50px;
        }
        .form-container h3 {
            text-align: center;
        }
    </style>
</head>
<body>
        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">Sistema bibliotecario <small>Editar libro</small></h1>
            </div> 
           <!--  <h2 class="text-center">¡Bienvenido a la sección de edición!</h2>
            <h2 class="text-center">A continuación ingresa el libro que deseas editar:</h2> -->
            <div class="container-fluid" style="margin: 40px 0;">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <img src="assets/img/editar.png" alt="pdf" class="img-responsive center-box" style="max-width: 250px;">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                       ¡Bienvenido a la sección de edición!
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                       A continuación ingresa el libro que deseas editar:
                    </div>
                </div>
            <!-- Formulario de búsqueda -->
            <form action="" method="POST" class="text-center" style="margin: 50px 0;">
                <label for="criterio">Desea buscar mediante:</label>
                <select name="criterio" class="form-control" style="width: 150px; display: inline-block;">
                    <option value="titulo">Título</option>
                    <option value="autor">Autor</option>
                    <option value="editorial">Editorial</option>
                    <option value="categoria">Categoría</option>
                </select>
                <input type="text" name="valor" placeholder="Ingrese el título, autor, editorial o categoría" required class="form-control" style="width: 300px; display: inline-block;">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (isset($no_resultado)): ?>
            <div class="alert alert-warning">No se encontraron resultados.</div>
        <?php elseif (isset($resultados)): ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ubicación</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Numero de ejemplares</th>
                        <th>Categoría</th>
                        <th>Condición</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $row): ?>
                        <tr>
                            <td><?php echo $row['clave']; ?></td>
                            <td><?php echo $row['titulo']; ?></td>
                            <td><?php echo $row['autor']; ?></td>
                            <td><?php echo $row['editorial']; ?></td>
                            <td><?php echo $row['no_ejemplares']; ?></td>
                            <td><?php echo $row['categoria']; ?></td>
                            <td><?php echo $row['estado']; ?></td>
                            <td><a href="?editar_id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if (isset($_GET['editar_id']) && isset($libro)): ?>
            <h3>Editar Libro</h3>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">
                <div class="form-group">
                    <label for="titulo">Ubicación</label>
                    <input type="text" name="clave" class="form-control" value="<?php echo $libro['clave']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control" value="<?php echo $libro['titulo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" class="form-control" value="<?php echo $libro['autor']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editorial">Editorial</label>
                    <input type="text" name="editorial" class="form-control" value="<?php echo $libro['editorial']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <input type="text" name="categoria" class="form-control" value="<?php echo $libro['categoria']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Condición</label>
                    <input type="text" name="estado" class="form-control" value="<?php echo $libro['estado']; ?>" required>
                </div>
                
                <a href="home.html"><button type="submit" name="editar" class="btn btn-success">Guardar Cambios</button></a>
                
            </form>
        <?php endif; ?>

        <?php if (isset($exito)): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>
    </div>
            <!-- Footer -->
            <?php include('footer.php'); ?>
</body>
</html>
</body>
</html>

