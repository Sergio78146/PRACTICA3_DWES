<?php
require 'conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listado.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $nombre_corto = $_POST['nombre_corto'];
    $precio = $_POST['precio'];
    $familia = $_POST['familia'];
    $descripcion = $_POST['descripcion'];

    try {
        $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, nombre_corto = ?, precio = ?, familia = ?, descripcion = ? WHERE codigo = ?");
        $stmt->execute([$nombre, $nombre_corto, $precio, $familia, $descripcion, $id]);
        header('Location: listado.php');
    } catch (PDOException $e) {
        die("Error al actualizar el producto: " . $e->getMessage());
    }
}

try {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE codigo = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        header('Location: listado.php');
        exit;
    }

    $familias = $pdo->query("SELECT * FROM familias")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al cargar datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar Producto</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_corto" class="form-label">Nombre Corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" class="form-control" value="<?= htmlspecialchars($producto['nombre_corto']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" id="precio" class="form-control" value="<?= htmlspecialchars($producto['precio']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="familia" class="form-label">Familia</label>
                <select name="familia" id="familia" class="form-select">
                    <?php foreach ($familias as $familia): ?>
                        <option value="<?= $familia['codigo'] ?>" <?= $producto['familia'] == $familia['codigo'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($familia['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="listado.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
