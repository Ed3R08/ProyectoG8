<?php
// ProyectoG8/Views/Categoria/registro.php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/CategoriaController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

// Si llega POST, delega al controlador
if (isset($_POST['btnGuardar'])) {
  CategoriaController::store();
  exit;
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
        <h3>Registrar Categoría</h3>

        <?php if (isset($_GET['ok'])): ?>
          <div class="alert alert-success">¡Categoría registrada!</div>
        <?php elseif (isset($_GET['err'])): ?>
          <div class="alert alert-danger">Error al registrar categoría.</div>
        <?php endif; ?>

        <form method="post" class="mt-4">
          <div class="form-group">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Ruta de la Imagen</label>
            <input type="url" name="ruta_imagen" class="form-control">
          </div>
          <button name="btnGuardar" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
  <?php AddJs(); ?>
</body>

</html>