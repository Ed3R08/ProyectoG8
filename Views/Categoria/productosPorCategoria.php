<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/categoriaModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/favoritosModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

$esAdmin = (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2);
$idUsuario = $_SESSION["IdUsuario"] ?? null;

// Obtener categoría
$idCategoria = isset($_GET['id']) ? intval($_GET['id']) : null;
$productos = [];
$categoria = null;

if ($idCategoria) {

    // ADMIN ve todas / CLIENTE solo activas
    $categorias = $esAdmin ? ListarCategoriasAdminModel() : ListarCategoriasModel();

    foreach ($categorias as $c) {
        if ($c['id_categoria'] == $idCategoria) {
            $categoria = $c;
            break;
        }
    }

    if ($categoria) {
        $productos = ListarProductosPorCategoriaModel($idCategoria);
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<style>
.heart {
    color: #ccc;
    font-size: 24px;
    transition: transform .1s ease, color .1s ease;
}
.heart.is-fav { color: #e74c3c; }
.btn-favorito { border:none; background:none; cursor:pointer; }
</style>

<body>
<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>
<div class="page-wrapper">
<div class="container-fluid">

<?php if (!$categoria): ?>

    <div class="alert alert-danger">
        Categoría no encontrada o inactiva.
    </div>
    <a href="listado.php" class="btn btn-secondary">← Volver</a>

<?php else: ?>

<h3>
    Productos de la categoría: <?= htmlspecialchars($categoria['descripcion']) ?>

    <?php if ($esAdmin): ?>
        <?php if ($categoria['activo'] == 1): ?>
            <span class="badge bg-success ms-2">Activa</span>
        <?php else: ?>
            <span class="badge bg-danger ms-2">Inactiva</span>
        <?php endif; ?>
    <?php endif; ?>
</h3>

<div id="mensaje-carrito" style="margin-bottom:10px;"></div>

<table class="table table-bordered">
<thead>
<tr>
    <th>Nombre</th>
    <th>Detalle</th>
    <th>Precio</th>
    <th>Existencias</th>
    <th>Imagen</th>
    <th>Favorito</th>
    <th>Comprar</th>
</tr>
</thead>

<tbody>

<?php if (!empty($productos)): ?>
<?php foreach ($productos as $p): ?>
<tr>

<td><?= htmlspecialchars($p['nombre']) ?></td>
<td><?= htmlspecialchars($p['detalle']) ?></td>
<td>₡<?= number_format($p['precio'], 2) ?></td>
<td><?= $p['existencias'] ?></td>

<td>
<?php if (!empty($p['ruta_imagen'])): ?>
    <img src="<?= htmlspecialchars($p['ruta_imagen']) ?>" style="height:40px;">
<?php endif; ?>
</td>

<!-- FAVORITO -->
<td>
<?php if ($idUsuario): ?>
    <?php 
        $favoritos = ListarFavoritosUsuarioModel($idUsuario);
        $favoritosIds = array_column($favoritos, 'id_producto');
        $esFav = in_array($p['id_producto'], $favoritosIds);
    ?>
    <button class="btn-favorito"
            data-producto="<?= $p['id_producto'] ?>"
            data-fav="<?= $esFav ? 1 : 0 ?>">
        <span class="heart <?= $esFav ? 'is-fav' : '' ?>">♥</span>
    </button>
<?php else: ?>
    <span>-</span>
<?php endif; ?>
</td>

<!-- COMPRAR -->
<td>
<?php if (!$esAdmin && $idUsuario): ?>

    <?php if ($p['estado'] == 1): ?>
        <form class="agregar-carrito-form" data-producto="<?= $p['id_producto'] ?>" style="display:inline-block">
            <input type="number" 
                   value="1" 
                   min="1" 
                   max="<?= $p['existencias'] ?>"
                   class="form-control cantidad-input"
                   style="width:70px; display:inline;">
            <button type="button" class="btn btn-primary btn-sm btn-agregar">Agregar</button>
        </form>
    <?php else: ?>
        <span class="text-muted">No disponible</span>
    <?php endif; ?>

<?php elseif (!$idUsuario): ?>
    <span class="text-muted">Inicia sesión</span>
<?php endif; ?>
</td>

</tr>
<?php endforeach; ?>

<?php else: ?>
<tr><td colspan="7" class="text-center">No hay productos en esta categoría.</td></tr>
<?php endif; ?>

</tbody>
</table>

<a href="listado.php" class="btn btn-secondary mt-3">← Volver a Categorías</a>

<?php endif; ?>

</div>
</div>
</div>

<?php AddJs(); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {

// FAVORITOS
document.querySelectorAll(".btn-favorito").forEach(btn => {
    btn.addEventListener("click", function() {
        let fav = this.dataset.fav == 1;
        let id = this.dataset.producto;
        let accion = fav ? "eliminar" : "agregar";

        let fd = new FormData();
        fd.append("producto_id", id);

        fetch(window.location.origin + "/ProyectoG8/Controllers/favoritosController.php?accion=" + accion, {
            method: "POST",
            body: fd
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                this.dataset.fav = fav ? 0 : 1;
                this.querySelector(".heart").classList.toggle("is-fav");
            } else alert(d.message || "Error");
        });
    });
});

// CARRITO
document.querySelectorAll(".btn-agregar").forEach(btn => {
    btn.addEventListener("click", function() {

        let form = this.closest(".agregar-carrito-form");
        let id = form.dataset.producto;
        let cant = form.querySelector(".cantidad-input").value;

        let fd = new FormData();
        fd.append("producto_id", id);
        fd.append("cantidad", cant);

        fetch(window.location.origin + "/ProyectoG8/Controllers/carritoController.php?accion=agregar", {
            method: "POST",
            body: fd
        })
        .then(r => r.json())
        .then(d => {
            document.getElementById("mensaje-carrito").innerHTML =
                `<div class="alert alert-${d.success ? 'success' : 'danger'}">${d.message}</div>`;
            setTimeout(() => document.getElementById("mensaje-carrito").innerHTML = "", 3000);
        });
    });
});

});
</script>

</body>
</html>
