<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al formulario de login si no está autenticado
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];
    $clave = $_POST['clave'];
    $no_ejemplares = $_POST['no_ejemplares'];

    // Validar que no haya campos vacíos
    if (empty($titulo) || empty($autor) || empty($editorial) || empty($categoria) || empty($estado) || empty($clave) || empty($no_ejemplares)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Insertar el nuevo libro en la base de datos
        $sql = "INSERT INTO libros (clave, titulo, autor, editorial, categoria, estado, no_ejemplares) VALUES (:clave, :titulo, :autor, :editorial, :categoria, :estado, :no_ejemplares)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':clave', $clave, PDO::PARAM_STR);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':autor', $autor, PDO::PARAM_STR);
        $stmt->bindValue(':editorial', $editorial, PDO::PARAM_STR);
        $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':no_ejemplares', $no_ejemplares, PDO::PARAM_INT);
        $stmt->execute();

        $exito = "El libro ha sido agregado correctamente.";
    }
}
?>
<a href="logout.php"><button type='button' class='btn btn-outline-light'>Salir</button></a>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('header.php'); ?>
    <title>Agregar Nuevo Libro</title>
    <style>
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
            <h1 class="all-tittles">Sistema bibliotecario <small>Agregar nuevo libro</small></h1>
        </div>

        <!-- Mensaje de éxito o error -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (isset($exito)): ?>
            <div class="alert alert-success"><?php echo $exito; ?></div>
        <?php endif; ?>

        <!-- Formulario de ingreso de nuevo libro -->
        <div class="form-container">
            <h3>Agregar Nuevo Libro</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="clave">Ubicación (Clave)</label>
                    <input type="text" name="clave" class="form-control" placeholder="Clave del libro" required>
                </div>
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Título del libro" required>
                </div>
                <div class="form-group">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" class="form-control" placeholder="Autor del libro" required>
                </div>
                <div class="form-group">
                    <label for="editorial">Editorial</label>
                    <input type="text" name="editorial" class="form-control" placeholder="Editorial del libro" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <input type="text" name="categoria" class="form-control" placeholder="Categoría del libro" required>
                </div>
                <div class="form-group">
                    <label for="estado">Condición</label>
                    <input type="text" name="estado" class="form-control" placeholder="Condición del libro" required>
                </div>
                <div class="form-group">
                    <label for="no_ejemplares">Número de ejemplares</label>
                    <input type="number" name="no_ejemplares" class="form-control" placeholder="Número de ejemplares" required>
                </div>
                
                <button type="submit" class="btn btn-success">Agregar Libro</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>
</body>
</html>
