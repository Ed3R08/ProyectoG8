<?php
// ProyectoG8/Views/Categoria/listado.php

// 1) Incluye el modelo (sin invocar al controlador en este archivo)
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';

// 2) Obtiene los datos
$categorias = ListarCategoriasModel();

// 3) Incluir el layout
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
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
        <h3>Lista de Categorías</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Descripción</th>
              <th>Imagen</th>
              <?php if (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2): ?>
                <th>Acciones</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($categorias)): ?>
              <?php foreach ($categorias as $c): ?>
                <tr>
                  <td><?= $c['id_categoria'] ?></td>
                  <td><?= htmlspecialchars($c['descripcion']) ?></td>
                  <td>
                    <?php if ($c['ruta_imagen']): ?>
                      <img src="<?= $c['ruta_imagen'] ?>" alt="" style="height:40px">
                    <?php endif; ?>
                  </td>
                  <?php if (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2): ?>
                    <td>
                      <a href="/ProyectoG8/Views/Categoria/editarCategoria.php?id=<?= $c['id_categoria'] ?>"
                        class="btn btn-sm btn-primary">Editar</a>

                      <form method="post" action="../../Controllers/categoriaController.php" style="display:inline-block"
                        onsubmit="return confirm('¿Desea eliminar esta categoría?');">
                        <input type="hidden" name="id" value="<?= $c['id_categoria'] ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                      </form>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">No hay categorías registradas.</td>
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