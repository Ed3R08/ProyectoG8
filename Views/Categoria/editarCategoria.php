<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/categoriaModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

// Obtener ID de la categoría
$id = isset($_GET['id']) ? $_GET['id'] : null;
$categoria = null;

if ($id !== null) {
    $categorias = ListarCategoriasModel();
    foreach ($categorias as $c) {
        if ($c['id_categoria'] == $id) {
            $categoria = $c;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
    <div id="main-wrapper">
        <?php ShowHeader(); ShowMenu(); ?>
        <div class="page-wrapper">
            <div class="container-fluid">

                <h3>Editar Categoría</h3>

                <?php if ($categoria): ?>
                    <form action="../../Controllers/categoriaController.php?action=editar"
                          method="post"
                          enctype="multipart/form-data"
                          class="mt-4">

                        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                        <input type="hidden" name="ruta_actual" value="<?= htmlspecialchars($categoria['ruta_imagen']) ?>">

                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control"
                               value="<?= htmlspecialchars($categoria['descripcion']) ?>" required>

                        <br>
                        <label>Imagen actual</label><br>
                        <?php if (!empty($categoria['ruta_imagen'])): ?>
                            <img src="<?= $categoria['ruta_imagen'] ?>" style="height:60px; border-radius:5px;">
                        <?php endif; ?>

                        <br><br>
                        <label>Subir nueva imagen (opcional)</label>
                        <input type="file" name="imagen" class="form-control">

                        <button name="btnEditarCategoria" type="submit" class="btn btn-success mt-3">Guardar</button>
                    </form>
                <?php else: ?>
                    <p class="text-danger">Categoría no encontrada.</p>
                <?php endif; ?>

                <?php AddJs(); ?>
            </div>
        </div>
    </div>
</body>
</html>
