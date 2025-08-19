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
<h1>Editar categoría</h1>

<?php if ($categoria): ?>
    <form action="../../Controllers/categoriaController.php?action=editar" method="post" class="mt-4">
        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id_categoria']) ?>">

        <label>Descripción</label>
        <input type="text" name="descripcion" class="form-control" 
               value="<?= htmlspecialchars($categoria['descripcion']) ?>" required>

        <label>URL Imagen</label>
        <input type="text" name="ruta_imagen" class="form-control" 
               value="<?= htmlspecialchars($categoria['ruta_imagen']) ?>">

       <?php
$activo = isset($_POST['activo']) ? $_POST['activo'] : (isset($categoria['activo']) ? $categoria['activo'] : 0);
?>
<label>Activo</label>
<select name="activo" class="form-control">
    <option value="1" <?= ($activo == 1 ? 'selected' : '') ?>>Sí</option>
    <option value="0" <?= ($activo == 0 ? 'selected' : '') ?>>No</option>
</select>

        <button name="btnEditarCategoria" type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
<?php else: ?>
    <p class="text-danger">Categoría no encontrada.</p>
<?php endif; ?>



<?php AddJs(); ?>
</body>
</html>