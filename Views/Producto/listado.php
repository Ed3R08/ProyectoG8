<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';

// Carga todos los productos sin filtro
$productos = ListarProductosModel();

// Función para filtrar productos por precio en PHP puro
function filtrarProductosPorPrecio($productos, $min = 0, $max = PHP_INT_MAX) {
    $filtrados = [];
    foreach ($productos as $p) {
        $precio = floatval($p['precio']);
        if ($precio >= $min && $precio <= $max) {
            $filtrados[] = $p;
        }
    }
    return $filtrados;
}

// Obtener los valores mínimos y máximos de precio desde el formulario (GET)
$min = isset($_GET['min']) ? floatval($_GET['min']) : 0;
$max = isset($_GET['max']) ? floatval($_GET['max']) : PHP_INT_MAX;

// Filtrar productos con base en el rango de precio
$productosFiltrados = filtrarProductosPorPrecio($productos, $min, $max);

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

        <!-- Formulario para filtrar por precio -->
        <form method="get" class="mb-3">
          <label for="min">Precio mínimo:</label>
          <input type="number" step="0.01" name="min" id="min" value="<?= htmlspecialchars($min) ?>" placeholder="0">

          <label for="max" style="margin-left: 10px;">Precio máximo:</label>
          <input type="number" step="0.01" name="max" id="max" value="<?= $max !== PHP_INT_MAX ? htmlspecialchars($max) : '' ?>" placeholder="Sin límite">

          <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 10px;">Filtrar</button>
          <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="btn btn-secondary btn-sm" style="margin-left: 5px;">Limpiar filtro</a>
        </form>

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
            <?php if (!empty($productosFiltrados)): ?>
              <?php foreach($productosFiltrados as $p): ?>
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
                    if (isset($_SESSION['Nombre']) && isset($_SESSION['IdRol']) && $_SESSION['IdRol'] != 2): ?>
                      <form action="http://localhost:80/ProyectoG8/Controllers/carritoController.php?accion=agregar" method="POST">
                        <input type="hidden" name="producto_id" value="<?= $p['id_producto'] ?>">
                        <input type="number" name="cantidad" value="1" min="1" class="form-control" style="width:60px; display:inline;">
                        <button type="submit" class="btn btn-sm btn-primary">Agregar</button>
                      </form>
                    <?php elseif (!isset($_SESSION['Nombre'])): ?>
                      <span class="text-muted">Inicia sesión para comprar</span>
                    <?php else: ?>
                      <span class="text-muted">No disponible para administradores</span>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2): ?>
                      <a href="/ProyectoG8/Views/Producto/editar.php?id=<?= $p['id_producto'] ?>" class="btn btn-sm btn-danger">Editar</a>
                       <form method="post" action="../../Controllers/productoController.php" style="display:inline-block" onsubmit="return confirm('¿Desea eliminar este producto?');">
    <input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
    <input type="hidden" name="accion" value="eliminar">
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">No hay productos para mostrar.</td>
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