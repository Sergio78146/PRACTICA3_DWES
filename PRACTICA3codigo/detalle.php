<?php
require 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listado.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE codigo = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        header('Location: listado.php');
        exit;
    }
} catch (PDOException $e) {
    die("Error al obtener los detalles: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalles del Producto</h1>
        <table class="table table-striped">
            <tr><th>Código</th><td><?= htmlspecialchars($producto['codigo']) ?></td></tr>
            <tr><th>Nombre</th><td><?= htmlspecialchars($producto['nombre']) ?></td></tr>
            <tr><th>Nombre Corto</th><td><?= htmlspecialchars($producto['nombre_corto']) ?></td></tr>
            <tr><th>Precio</th><td><?= htmlspecialchars($producto['precio']) ?></td></tr>
            <tr><th>Familia</th><td><?= htmlspecialchars($producto['familia']) ?></td></tr>
            <tr><th>Descripción</th><td><?= htmlspecialchars($producto['descripcion']) ?></td></tr>
        </table>
        <a href="listado.php" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
