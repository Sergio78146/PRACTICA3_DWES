<?php
require 'conexion.php';

try {
    $query = $pdo->query("SELECT * FROM productos");
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al acceder a los datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Productos</h1>
        <a href="crear.php" class="btn btn-primary mb-3">Crear Producto</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['codigo']) ?></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td>
                            <a href="detalle.php?id=<?= $producto['codigo'] ?>" class="btn btn-info btn-sm">Detalles</a>
                            <a href="update.php?id=<?= $producto['codigo'] ?>" class="btn btn-warning btn-sm">Actualizar</a>
                            <a href="borrar.php?id=<?= $producto['codigo'] ?>" class="btn btn-danger btn-sm">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
