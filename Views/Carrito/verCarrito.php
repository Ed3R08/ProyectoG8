<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/carritoModel.php';
session_start();

// Validar sesión y que no sea administrador (IdRol == 2)
if (!isset($_SESSION['IdUsuario']) || !isset($_SESSION['IdRol']) || $_SESSION['IdRol'] == 2) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION['IdUsuario'];
$carrito = CarritoModel::ver($usuarioId);

// Incluir layout general
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
        <h2>Mi Carrito de Compras</h2>
        <a href="http://localhost:80/ProyectoG8/Views/Producto/listado.php" class="btn btn-success mb-3">
          Agregar más productos
        </a>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($carrito)): ?>
              <?php foreach ($carrito as $item): ?>
                <tr>
                  <td><?= htmlspecialchars($item['nombre']) ?></td>
                  <td><?= number_format($item['precio'], 2) ?></td>
                  <td>
                    <form action="../../Controllers/carritoController.php?accion=actualizar" method="POST">
                      <input type="hidden" name="carrito_id" value="<?= $item['id'] ?>">
                      <input type="number" name="nueva_cantidad" value="<?= $item['cantidad'] ?>" min="1" class="form-control" style="width:70px;">
                      <button type="submit" class="btn btn-sm btn-success mt-1">Actualizar</button>
                    </form>
                  </td>
                  <td><?= number_format($item['subtotal'], 2) ?></td>
                  <td>
                    <form action="../../Controllers/carritoController.php?accion=eliminar" method="POST">
                      <input type="hidden" name="carrito_id" value="<?= $item['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">El carrito está vacío.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <?php if (!empty($carrito)): ?>
          <form action="../../Controllers/carritoController.php?accion=finalizar" method="POST">
          <button type="submit" class="btn btn-primary mt-3">Finalizar compra</button>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php AddJs(); ?>
</body>
</html>
