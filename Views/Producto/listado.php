<?php
// 1) carga el modelo
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/ProductoModel.php';
$productos = ListarProductosModel();

// 2) incluye layout
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>
<body>
  <div id="main-wrapper">
    <?php ShowHeader(); ShowMenu(); ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <h3>Lista de Productos</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th><th>Nombre</th><th>Precio</th><th>Existencias</th><th>Imagen</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($productos)): ?>
              <?php foreach($productos as $p): ?>
                <tr>
                  <td><?= $p['id_producto'] ?></td>
                  <td><?= htmlspecialchars($p['nombre']) ?></td>
                  <td><?= number_format($p['precio'],2) ?></td>
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
                <td colspan="5" class="text-center">No hay productos registrados.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php AddJs(); ?>
</body>
</html>
