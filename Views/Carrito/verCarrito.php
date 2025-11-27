<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/carritoModel.php';
session_start();

if (!isset($_SESSION['IdUsuario']) || $_SESSION['IdRol'] == 2) {
    header("Location: ../Home/login.php");
    exit();
}

$carrito = CarritoModel::ver($_SESSION['IdUsuario']);
require_once __DIR__ . '/../layoutInterno.php';
?>

<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>
<body>

<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>
<div class="page-wrapper">
<div class="container-fluid">

<h2>Mi Carrito</h2>

<a href="../Producto/listado.php" class="btn btn-success mb-3">Agregar productos</a>

<table class="table table-bordered">
<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th></tr>

<?php if ($carrito): foreach ($carrito as $i): ?>
<tr>
<td><?= htmlspecialchars($i['nombre']) ?></td>
<td><?= number_format($i['precio'],2) ?></td>

<td>
<form method="post" action="../../Controllers/carritoController.php?accion=actualizar">
<input type="hidden" name="carrito_id" value="<?= $i['id_carrito'] ?>">
<input type="number" name="nueva_cantidad" value="<?= $i['cantidad'] ?>" min="1" style="width:60px">
<button class="btn btn-sm btn-success">Actualizar</button>
</form>
</td>

<td><?= number_format($i['subtotal'],2) ?></td>

<td>
<form method="post" action="../../Controllers/carritoController.php?accion=eliminar">
<input type="hidden" name="carrito_id" value="<?= $i['id_carrito'] ?>">
<button class="btn btn-sm btn-danger">Eliminar</button>
</form>
</td>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="5">Carrito vacío</td></tr>
<?php endif; ?>

</table>

<?php if ($carrito): ?>
<form method="post" action="../../Controllers/carritoController.php?accion=finalizar">
<button class="btn btn-primary">Finalizar compra</button>
</form>
<?php endif; ?>

</div></div></div>

<?php AddJs(); ?>

</body>
</html>
