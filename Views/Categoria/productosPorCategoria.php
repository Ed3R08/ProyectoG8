<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/categoriaModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

// Obtener el id de categoría
$idCategoria = isset($_GET['id']) ? intval($_GET['id']) : null;
$productos = [];
$categoria = null;

if ($idCategoria) {
  $productos = ListarProductosPorCategoriaModel($idCategoria);
  $categorias = ListarCategoriasModel();
  foreach ($categorias as $c) {
    if ($c['id_categoria'] == $idCategoria) {
      $categoria = $c;
      break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
  <div id="main-wrapper">
    <?php ShowHeader();
    ShowMenu(); ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <h3>Productos de la categoría: <?= htmlspecialchars($categoria['descripcion'] ?? 'Desconocida') ?></h3>

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
                    <?php if ($p['ruta_imagen']): ?>
                      <img src="<?= $p['ruta_imagen'] ?>" alt="" style="height:40px">
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">No hay productos en esta categoría.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <a href="listado.php" class="btn btn-secondary">← Volver a Categorías</a>
      </div>
    </div>
  </div>
  <?php AddJs(); ?>
</body>

</html>