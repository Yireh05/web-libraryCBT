<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
} else {
    $error = "Método de solicitud no válido.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include('header.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">Sistema bibliotecario <small>Búsqueda de libro</small></h1>
            </div>
            <h2 class="text-center">¡Bienvenido a la sección de búsqueda!</h2>
            <h2 class="text-center">A continuación elige la opción por la que deseas realizar tu búsqueda</h2>

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

                <!-- Mostrar resultados en tabla -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ubicación</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Categoría</th>
                            <th>Libros existentes</th>
                            <th>Condición</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['clave']); ?></td>
                                <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($row['autor']); ?></td>
                                <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                                <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_ejemplares']); ?></td>
                                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </div>

        <!-- Footer -->
        <?php include('footer.php'); ?>
