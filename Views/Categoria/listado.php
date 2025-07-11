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
    <?php ShowHeader(); ShowMenu(); ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <h3>Lista de Categorías</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th><th>Descripción</th><th>Imagen</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($categorias)): ?>
              <?php foreach($categorias as $c): ?>
                <tr>
                  <td><?= $c['id_categoria'] ?></td>
                  <td><?= htmlspecialchars($c['descripcion']) ?></td>
                  <td>
                    <?php if ($c['ruta_imagen']): ?>
                      <img src="<?= $c['ruta_imagen'] ?>" alt="" style="height:40px">
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">No hay categorías registradas.</td>
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
