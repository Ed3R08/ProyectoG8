<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';

$esAdmin = (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2);

// Admin → ver todas las categorías
// Cliente → solo activas
if ($esAdmin) {
    $categorias = ListarCategoriasAdminModel();
} else {
    $categorias = ListarCategoriasModel(); // solo activas
}

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
    <th>Categoría</th>
    <th>Imagen</th>
    <?php if ($esAdmin): ?>
        <th>Estado</th>
        <th>Acciones</th>
    <?php endif; ?>
</tr>
</thead>
<tbody>

<?php if (!empty($categorias)): ?>
    <?php foreach ($categorias as $c): ?>

        <?php
        // 🔥 REDIRECCIÓN ESPECIAL PARA SERVICIOS (ID = 8)
        if ($c['id_categoria'] == 8) {

            if ($esAdmin) {
                $link = "/ProyectoG8/Views/Visitas/panelAdmin.php"; // Admin a panel
            } else {
                $link = "/ProyectoG8/Views/Visitas/misVisitas.php"; // Cliente a agendar
            }

        } else {
            // Comportamiento normal
            $link = "/ProyectoG8/Views/Categoria/productosPorCategoria.php?id=" . $c['id_categoria'];
        }
        ?>

        <tr>

            <td>
                <a href="<?= $link ?>">
                    <?= htmlspecialchars($c['descripcion']) ?>
                </a>
            </td>

            <td>
                <?php if (!empty($c['ruta_imagen'])): ?>
                    <img src="<?= $c['ruta_imagen'] ?>" style="height:40px;">
                <?php endif; ?>
            </td>

            <?php if ($esAdmin): ?>
            <td>
                <?php if ($c['activo'] == 1): ?>
                    <span class="badge bg-success">Activa</span>
                <?php else: ?>
                    <span class="badge bg-danger">Inactiva</span>
                <?php endif; ?>
            </td>

            <td>
                <a href="/ProyectoG8/Views/Categoria/editarCategoria.php?id=<?= $c['id_categoria'] ?>"
                   class="btn btn-sm btn-warning">Editar</a>

                <?php if ($c['activo'] == 1): ?>
                    <!-- Desactivar -->
                    <form method="post" action="../../Controllers/categoriaController.php"
                          style="display:inline-block"
                          onsubmit="return confirm('¿Desactivar esta categoría?');">
                        <input type="hidden" name="id" value="<?= $c['id_categoria'] ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <button class="btn btn-sm btn-danger">Desactivar</button>
                    </form>
                <?php else: ?>
                    <!-- Activar -->
                    <form method="post" action="../../Controllers/categoriaController.php"
                          style="display:inline-block"
                          onsubmit="return confirm('¿Activar esta categoría?');">
                        <input type="hidden" name="id" value="<?= $c['id_categoria'] ?>">
                        <input type="hidden" name="accion" value="activar">
                        <button class="btn btn-sm btn-success">Activar</button>
                    </form>
                <?php endif; ?>
            </td>
            <?php endif; ?>

        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="<?= $esAdmin ? 4 : 2 ?>" class="text-center">
            No hay categorías registradas.
        </td>
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
