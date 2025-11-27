<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/categoriaModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

// ¿Es admin?
$esAdmin = (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2);

// Obtener el id de categoría
$idCategoria = isset($_GET['id']) ? intval($_GET['id']) : null;
$productos = [];
$categoria = null;

if ($idCategoria) {

  // ADMIN ve todas, cliente solo activas
  if ($esAdmin) {
      $categorias = ListarCategoriasAdminModel();
  } else {
      $categorias = ListarCategoriasModel(); // solo activas
  }

  foreach ($categorias as $c) {
    if ($c['id_categoria'] == $idCategoria) {
        $categoria = $c;
        break;
    }
  }

  // Si existe la categoría, cargamos productos
  if ($categoria) {
      $productos = ListarProductosPorCategoriaModel($idCategoria);
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>
<div class="page-wrapper">
<div class="container-fluid">

<?php if (!$categoria): ?>

    <div class="alert alert-danger">
        Categoría no encontrada o inactiva.
    </div>
    <a href="listado.php" class="btn btn-secondary">← Volver</a>

<?php else: ?>

<h3>
    Productos de la categoría: <?= htmlspecialchars($categoria['descripcion']) ?>

    <?php if ($esAdmin): ?>
        <?php if ($categoria['activo'] == 1): ?>
            <span class="badge bg-success ms-2">Activa</span>
        <?php else: ?>
            <span class="badge bg-danger ms-2">Inactiva</span>
        <?php endif; ?>
    <?php endif; ?>
</h3>

<?php if (!$esAdmin && $categoria['activo'] == 0): ?>

    <div class="alert alert-warning">
        Esta categoría está desactivada y no está disponible actualmente.
    </div>

<?php else: ?>

<table class="table table-bordered">
<thead>
<tr>
    <th>Nombre</th>
    <th>Detalle</th>
    <th>Precio</th>
    <th>Existencias</th>
    <th>Imagen</th>
</tr>
</thead>
<tbody>

<?php if (!empty($productos)): ?>
  <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['detalle']) ?></td>
        <td>₡<?= number_format($p['precio'], 2) ?></td>
        <td><?= $p['existencias'] ?></td>
        <td>
            <?php if (!empty($p['ruta_imagen'])): ?>
                <img src="<?= $p['ruta_imagen'] ?>" style="height:40px">
            <?php endif; ?>
        </td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5" class="text-center">No hay productos en esta categoría.</td>
    </tr>
<?php endif; ?>

</tbody>
</table>

<?php endif; ?>

<a href="listado.php" class="btn btn-secondary mt-3">← Volver a Categorías</a>

<?php endif; ?>

</div>
</div>
</div>
<?php AddJs(); ?>
</body>
</html>
