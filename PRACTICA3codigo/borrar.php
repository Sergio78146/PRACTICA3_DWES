<?php
require 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listado.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE codigo = ?");
    $stmt->execute([$id]);
} catch (PDOException $e) {
    die("Error al borrar el producto: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Producto Eliminado</h1>
        <p>El producto con el código <?= htmlspecialchars($id) ?> se ha eliminado correctamente.</p>
        <a href="listado.php" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>
