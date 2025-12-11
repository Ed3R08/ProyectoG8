<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../Home/login.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/DireccionModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

$direcciones = DireccionModel::listarPorUsuario($_SESSION['IdUsuario']);
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>

<div class="page-wrapper">
<div class="container-fluid">

<h3>Mis direcciones</h3>

<?php if (!empty($_GET['msg'])): ?>
  <div class="alert alert-success">
    <?php echo htmlspecialchars($_GET['msg']); ?>
  </div>
<?php endif; ?>

<!-- FORM NUEVA DIRECCIÓN -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Agregar nueva dirección</h5>
    <form method="post" action="../../Controllers/direccionController.php?accion=crear">
      <div class="form-row">
        <div class="form-group col-md-3">
          <label>Provincia</label>
          <input type="text" name="provincia" class="form-control" required>
        </div>
        <div class="form-group col-md-3">
          <label>Cantón</label>
          <input type="text" name="canton" class="form-control" required>
        </div>
        <div class="form-group col-md-3">
          <label>Distrito</label>
          <input type="text" name="distrito" class="form-control" required>
        </div>
        <div class="form-group col-md-3">
          <label>Código postal</label>
          <input type="number" name="codigo_postal" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label>Dirección detallada</label>
        <input type="text" name="detalle" class="form-control" required>
      </div>
      <button class="btn btn-primary">Guardar dirección</button>
    </form>
  </div>
</div>

<!-- LISTADO DE DIRECCIONES -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Direcciones registradas</h5>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Provincia</th>
          <th>Cantón</th>
          <th>Distrito</th>
          <th>Detalle</th>
          <th>Código postal</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($direcciones): ?>
        <?php foreach ($direcciones as $dir): ?>
          <tr>
            <td><?php echo htmlspecialchars($dir['id_direccion']); ?></td>
            <td><?php echo htmlspecialchars($dir['provincia']); ?></td>
            <td><?php echo htmlspecialchars($dir['canton']); ?></td>
            <td><?php echo htmlspecialchars($dir['distrito']); ?></td>
            <td><?php echo htmlspecialchars($dir['direccion_detallada']); ?></td>
            <td><?php echo htmlspecialchars($dir['codigo_postal']); ?></td>
            <td>
              <!-- EDITAR -->
              <form method="post" action="../../Controllers/direccionController.php?accion=actualizar" style="display:inline-block; max-width:350px;">
                <input type="hidden" name="id_direccion" value="<?php echo $dir['id_direccion']; ?>">
                <input type="text"   name="provincia"       value="<?php echo htmlspecialchars($dir['provincia']); ?>" class="form-control mb-1" placeholder="Provincia" required>
                <input type="text"   name="canton"          value="<?php echo htmlspecialchars($dir['canton']); ?>" class="form-control mb-1" placeholder="Cantón" required>
                <input type="text"   name="distrito"        value="<?php echo htmlspecialchars($dir['distrito']); ?>" class="form-control mb-1" placeholder="Distrito" required>
                <input type="text"   name="detalle"         value="<?php echo htmlspecialchars($dir['direccion_detallada']); ?>" class="form-control mb-1" placeholder="Detalle" required>
                <input type="number" name="codigo_postal"   value="<?php echo htmlspecialchars($dir['codigo_postal']); ?>" class="form-control mb-1" placeholder="Código postal">
                <button class="btn btn-sm btn-warning">Actualizar</button>
              </form>

              <!-- ELIMINAR -->
              <form method="post" action="../../Controllers/direccionController.php?accion=eliminar"
                    style="display:inline-block;"
                    onsubmit="return confirm('¿Eliminar esta dirección?');">
                <input type="hidden" name="id_direccion" value="<?php echo $dir['id_direccion']; ?>">
                <button class="btn btn-sm btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="7">No tienes direcciones registradas.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>

  </div>
</div>

</div>
</div>
</div>

<?php AddJs(); ?>
</body>
</html>