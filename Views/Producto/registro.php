<?php
// 0) Procesar POST llamando al controlador
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/ProductoController.php';
if (isset($_POST['btnGuardar'])) {
    ProductoController::store();
    exit;
}

// 1) Cargar el modelo de categorías para el dropdown
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';
$categorias = ListarCategoriasModel();

// 2) Incluir el layout (cabecera, menú, etc.)
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
        <h3>Registrar Producto</h3>

        <!-- Mensajes de éxito o error -->
        <?php if (isset($_GET['ok'])): ?>
          <div class="alert alert-<?= $_GET['ok']==1 ? 'success' : 'danger' ?>">
            <?= $_GET['ok']==1 
               ? 'Producto registrado correctamente.'
               : 'Error al registrar el producto.' ?>
          </div>
        <?php endif; ?>

        <form action="" method="post" class="mt-4">
          <div class="form-group">
            <label>Categoría</label>
            <select name="categoria" class="form-control" required>
              <option value="">Seleccione…</option>
              <?php foreach($categorias as $c): ?>
                <option value="<?= $c['id_categoria'] ?>">
                  <?= htmlspecialchars($c['descripcion']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Detalle</label>
            <textarea name="detalle" class="form-control" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Existencias</label>
            <input type="number" name="existencias" class="form-control" required>
          </div>
          <div class="form-group">
            <label>URL Imagen</label>
            <input type="text" name="ruta_imagen" class="form-control">
          </div>
          <button name="btnGuardar" type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div>
  </div>
<?php AddJs(); ?>
</body>
</html>