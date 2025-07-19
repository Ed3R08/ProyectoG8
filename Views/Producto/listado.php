<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';

$productos = ListarProductosModel();

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
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Existencias</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($productos)): ?>
              <?php foreach($productos as $p): ?>
                <tr>
                  <td><?= $p['id_producto'] ?></td>
                  <td><?= htmlspecialchars($p['nombre']) ?></td>
                  <td><?= number_format($p['precio'], 2) ?></td>
                  <td><?= $p['existencias'] ?></td>
                  <td>
                    <?php if ($p['ruta_imagen']): ?>
                      <img src="<?= $p['ruta_imagen'] ?>" alt="" style="height:40px">
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                    // Mostrar botón "Agregar" solo si usuario está logueado y NO es admin (IdRol != 2)
                    if (isset($_SESSION['Nombre']) && isset($_SESSION['IdRol']) && $_SESSION['IdRol'] != 2): ?>
                      <form action="http://localhost:81/ProyectoG8/Controllers/carritoController.php?accion=agregar" method="POST">

                        <input type="hidden" name="producto_id" value="<?= $p['id_producto'] ?>">
                        <input type="number" name="cantidad" value="1" min="1" class="form-control" style="width:60px; display:inline;">
                        <button type="submit" class="btn btn-sm btn-primary">Agregar</button>
                      </form>
                    <?php elseif (!isset($_SESSION['Nombre'])): ?>
                      <span class="text-muted">Inicia sesión para comprar</span>
                    <?php else: ?>
                      <span class="text-muted">No disponible para administradores</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">No hay productos registrados.</td>
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
