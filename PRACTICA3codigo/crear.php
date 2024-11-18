<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $nombre_corto = $_POST['nombre_corto'];
    $precio = $_POST['precio'];
    $familia = $_POST['familia'];
    $descripcion = $_POST['descripcion'];

    try {
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, nombre_corto, precio, familia, descripcion) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $nombre_corto, $precio, $familia, $descripcion]);
        header('Location: listado.php');
    } catch (PDOException $e) {
        die("Error al crear el producto: " . $e->getMessage());
    }
}

$familias = $pdo->query("SELECT * FROM familias")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Producto</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre_corto" class="form-label">Nombre Corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" id="precio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="familia" class="form-label">Familia</label>
                <select name="familia" id="familia" class="form-select">
                    <?php foreach ($familias as $familia): ?>
                        <option value="<?= $familia['codigo'] ?>"><?= htmlspecialchars($familia['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
            <a href="listado.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
