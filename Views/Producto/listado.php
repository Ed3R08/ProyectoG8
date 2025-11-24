<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';

// Carga todos los productos
$productos = ListarProductosModel();

// ¿Es admin?
$esAdmin = (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2);

// Función para filtrar productos por precio y, para usuarios normales, solo activos
function filtrarProductosPorPrecio($productos, $min = 0, $max = PHP_INT_MAX, $soloActivos = true)
{
    $filtrados = [];
    foreach ($productos as $p) {
        $precio = floatval($p['precio'] ?? 0);

        if ($soloActivos && isset($p['estado']) && $p['estado'] != 1) {
            continue;
        }

        if ($precio >= $min && $precio <= $max) {
            $filtrados[] = $p;
        }
    }
    return $filtrados;
}

$min = isset($_GET['min']) ? floatval($_GET['min']) : 0;
$max = isset($_GET['max']) ? floatval($_GET['max']) : PHP_INT_MAX;

$productosFiltrados = filtrarProductosPorPrecio($productos, $min, $max, $soloActivos = !$esAdmin);

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
        <div id="mensaje-carrito" style="margin-bottom:10px;"></div>

        <form method="get" class="mb-3">
          <label for="min">Precio mínimo:</label>
          <input type="number" step="0.01" name="min" id="min"
                 value="<?= htmlspecialchars($min) ?>" placeholder="0">
          <label for="max" style="margin-left: 10px;">Precio máximo:</label>
          <input type="number" step="0.01" name="max" id="max"
                 value="<?= $max !== PHP_INT_MAX ? htmlspecialchars($max) : '' ?>" placeholder="Sin límite">
          <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 10px;">Filtrar</button>
          <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="btn btn-secondary btn-sm" style="margin-left: 5px;">Limpiar filtro</a>
        </form>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Existencias</th>
              <th>Imagen</th>
              <?php if ($esAdmin): ?>
                <th>Estado</th>
              <?php endif; ?>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($productosFiltrados)): ?>
              <?php foreach ($productosFiltrados as $p): ?>
                <tr>
                  <td><?= htmlspecialchars($p['nombre']) ?></td>
                  <td><?= number_format($p['precio'], 2) ?></td>
                  <td><?= $p['existencias'] ?></td>

                  <td>
                    <?php if (!empty($p['ruta_imagen'])): ?>
                      <img src="<?= $p['ruta_imagen'] ?>" alt="" style="height:40px">
                    <?php endif; ?>
                  </td>

                  <?php if ($esAdmin): ?>
                    <td>
                      <?php if ($p['estado'] == 1): ?>
                        <span class="badge" style="background-color:#28a745; color:white; padding:5px 10px; border-radius:5px;">
                          Activo
                        </span>
                      <?php else: ?>
                        <span class="badge" style="background-color:#dc3545; color:white; padding:5px 10px; border-radius:5px;">
                          Inactivo
                        </span>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>

                  <td>
                    <?php if (isset($_SESSION['Nombre']) && isset($_SESSION['IdRol']) && $_SESSION['IdRol'] != 2): ?>
                      <?php if ($p['estado'] == 1): ?>
                        <form class="agregar-carrito-form" data-producto="<?= $p['id_producto'] ?>" style="display:inline-block">
                          <input type="number" name="cantidad" value="1" min="1"
                                 class="form-control cantidad-input" style="width:60px; display:inline;">
                          <button type="button" class="btn btn-sm btn-primary btn-agregar">Agregar</button>
                        </form>
                      <?php else: ?>
                        <span class="text-muted">Producto no disponible</span>
                      <?php endif; ?>

                    <?php elseif (!isset($_SESSION['Nombre'])): ?>
                      <span class="text-muted">Inicia sesión para comprar</span>
                    <?php endif; ?>

                    <?php if ($esAdmin): ?>
                      <a href="/ProyectoG8/Views/Producto/editar.php?id=<?= $p['id_producto'] ?>" class="btn btn-sm btn-warning">
                        Editar
                      </a>

                      <?php if ($p['estado'] == 1): ?>
                        <form method="post" action="../../Controllers/productoController.php"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Desea desactivar este producto?');">
                          <input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
                          <input type="hidden" name="accion" value="eliminar">
                          <button type="submit" class="btn btn-sm btn-danger">Desactivar</button>
                        </form>
                      <?php else: ?>
                        <form method="post" action="../../Controllers/productoController.php"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Desea activar este producto?');">
                          <input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
                          <input type="hidden" name="accion" value="activar">
                          <button type="submit" class="btn btn-sm btn-success">Activar</button>
                        </form>
                      <?php endif; ?>
                    <?php endif; ?>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="<?= $esAdmin ? 6 : 5 ?>" class="text-center">No hay productos para mostrar.</td>
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
