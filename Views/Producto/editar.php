<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

// Obtener el producto por ID desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$producto = null;

if ($id !== null) {
    $productos = ListarProductosModel();
    foreach ($productos as $p) {
        if ($p['id_producto'] == $id) {
            $producto = $p;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>
<body>
<h1>Editar producto</h1>

<?php if ($producto): ?>
<form action="../../Controllers/productoController.php?action=editar" method="post" class="mt-4">
    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id_producto']) ?>">
    <label>Categoría</label>
    <input type="number" name="idCategoria" class="form-control" value="<" required>
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
    <label>Detalle</label>
    <textarea name="detalle" class="form-control" rows="3"><?= htmlspecialchars($producto['detalle']) ?></textarea>
    <label>Precio</label>
    <input type="number" step="0.01" name="precio" class="form-control" value="<?= htmlspecialchars($producto['precio']) ?>" required>
    <label>Existencias</label>
    <input type="number" name="existencias" class="form-control" value="<?= htmlspecialchars($producto['existencias']) ?>" required>
    <label>URL Imagen</label>
    <input type="text" name="ruta_imagen" class="form-control" value="<?= htmlspecialchars($producto['ruta_imagen']) ?>">
    <button name="btnEditarProducto" type="submit" class="btn btn-success">Guardar</button>
</form>
<?php else: ?>
<p class="text-danger">ID no especificado o producto no encontrado.</p>
<?php endif; ?>

<?php AddJs(); ?>
</body>
</html>