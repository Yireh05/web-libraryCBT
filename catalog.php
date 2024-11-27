<?php
include 'conexion.php'; 

// Definir cuántos libros se mostrarán por página
$libros_por_pagina = 50;

// Obtener el número total de libros
$sql_total_libros = "SELECT COUNT(*) FROM libros";
$stmt_total = $pdo->prepare($sql_total_libros);
$stmt_total->execute();
$total_libros = $stmt_total->fetchColumn();

// Calcular el número total de páginas
$total_paginas = ceil($total_libros / $libros_por_pagina);

// Obtener el número de la página actual
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; 

// Verificar si la página actual está dentro del rango
if ($pagina_actual < 1) {
    $pagina_actual = 1;
} elseif ($pagina_actual > $total_paginas) {
    $pagina_actual = $total_paginas;
}

// Calcular el desplazamiento para la consulta SQL
$offset = ($pagina_actual - 1) * $libros_por_pagina;

$sql = "SELECT * FROM libros LIMIT :limit OFFSET :offset"; 
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $libros_por_pagina, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($resultados)) {
    $no_resultado = true;
}
?>

<!DOCTYPE html> 
<html lang="es">
<head>
    <title>Catálogo</title>
    <?php include('header.php'); ?>
    <?php include('styles.php'); ?>

        <div class="container">
            <div class="page-header">
                <h1 class="all-tittles">Biblioteca Digital <small>Catálogo de libros</small></h1>
            </div>
        </div>

        <div class="container-fluid" style="margin: 40px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="assets/img/catalogo.png" alt="pdf" class="img-responsive center-box" style="max-width: 200px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido al catálogo, aqui encontraras todos los libros existentes en tu biblioteca, si deseas buscar un libro por título, autor o categoría, haz clic en la sección de libros y catálogo.
                </div>
            </div>
        </div>

        <!-- Mostrar los resultados de los libros -->
        <div class="container-fluid">
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
                    <?php if (isset($resultados)): ?>
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
                    <?php elseif (isset($no_resultado)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron libros.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
             

            <!-- Paginación -->
            <div class="pagination-container">
                <ul class="pagination">
                    <?php if ($pagina_actual > 1): ?>
                        <li><a href="?pagina=1">&laquo; Primero</a></li>
                        <li><a href="?pagina=<?php echo $pagina_actual - 1; ?>">Anterior</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="<?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                            <a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($pagina_actual < $total_paginas): ?>
                        <li><a href="?pagina=<?php echo $pagina_actual + 1; ?>">Siguiente</a></li>
                        <li><a href="?pagina=<?php echo $total_paginas; ?>">Último &raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <?php include('footer.php'); ?>
