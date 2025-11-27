<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/usuarioController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/favoritosModel.php';

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: /ProyectoG8/login.php");
    exit;
}

$idUsuario = $_SESSION["IdUsuario"];
$resultado = ConsultarInfoUsuario($idUsuario);
$favoritos = ListarFavoritosUsuarioModel($idUsuario);
?>

<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
<div id="main-wrapper">

<?php ShowHeader(); ShowMenu(); ?>

<div class="page-wrapper">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<h4 class="card-title">Perfil de Usuario</h4>

<table class="table table-bordered w-50">
<tr>
<th>Nombre</th>
<td><?= htmlspecialchars($resultado['NOMBRE']) ?></td>
</tr>
<tr>
<th>Correo</th>
<td><?= htmlspecialchars($resultado['CORREO']) ?></td>
</tr>
<tr>
<th>Identificación</th>
<td><?= htmlspecialchars($resultado['IDENTIFICACION']) ?></td>
</tr>
</table>

</div>
</div>

<div class="card mt-4">
<div class="card-body">

<h4 class="card-title">Mis Favoritos</h4>
<hr>

<?php if (!empty($favoritos)): ?>

<table class="table table-striped">
<thead>
<tr>
<th>Producto</th>
<th>Precio</th>
<th>Stock</th>
<th>Imagen</th>
<th>Acción</th>
</tr>
</thead>

<tbody>
<?php foreach ($favoritos as $p): ?>
<tr>
<td><?= htmlspecialchars($p['nombre']) ?></td>
<td>₡<?= number_format($p['precio'], 2) ?></td>
<td><?= (int)$p['existencias'] ?></td>
<td>
<?php if (!empty($p['ruta_imagen'])): ?>
<img src="<?= htmlspecialchars($p['ruta_imagen']) ?>" height="40">
<?php endif; ?>
</td>
<td>
<form method="post" action="/ProyectoG8/Controllers/favoritosController.php?accion=eliminar">
<input type="hidden" name="producto_id" value="<?= $p['id_producto'] ?>">
<button class="btn btn-sm btn-danger">Quitar</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php else: ?>
<p class="text-muted">No tienes favoritos aún.</p>
<?php endif; ?>

</div>
</div>

</div>
</div>
</div>

<?php AddJs(); ?>
</body>
</html>
