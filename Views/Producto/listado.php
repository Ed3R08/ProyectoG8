<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/productoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/favoritosModel.php';

// Carga todos los productos
$productos = ListarProductosModel();

// ¿Es admin?
$esAdmin = (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2);

// Obtener favoritos del usuario
$favoritosIds = [];
if (isset($_SESSION['IdUsuario'])) {
    $favoritos = ListarFavoritosUsuarioModel($_SESSION['IdUsuario']);
    foreach ($favoritos as $f) {
        $favoritosIds[] = $f['id_producto'];
    }
}

// Filtro por precio
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

// Admin → todos / Cliente → solo activos
$productosFiltrados = filtrarProductosPorPrecio($productos, $min, $max, !$esAdmin);

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
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

<h3>Lista de Productos</h3>
<div id="mensaje-carrito" style="margin-bottom:10px;"></div>

<form method="get" class="mb-3">
<label>Precio mínimo:</label>
<input type="number" step="0.01" name="min" value="<?= htmlspecialchars($min) ?>" placeholder="0">

<label style="margin-left:10px;">Precio máximo:</label>
<input type="number" step="0.01" name="max" value="<?= $max != PHP_INT_MAX ? htmlspecialchars($max) : '' ?>" placeholder="Sin límite">

<button class="btn btn-primary btn-sm">Filtrar</button>
<a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="btn btn-secondary btn-sm">Limpiar</a>
</form>

<table class="table table-striped">

<thead>
<tr>
<th>Nombre</th>
<th>Precio</th>
<th>Existencias</th>
<th>Imagen</th>
<th>Favorito</th>
<?php if ($esAdmin): ?><th>Estado</th><?php endif; ?>
<th>Acciones</th>
</tr>
</thead>

<tbody>

<?php foreach ($productosFiltrados as $p): ?>
<tr>

<td><?= htmlspecialchars($p['nombre']) ?></td>
<td><?= number_format($p['precio'], 2) ?></td>
<td><?= (int)$p['existencias'] ?></td>

<td>
<?php if (!empty($p['ruta_imagen'])): ?>
<img src="<?= htmlspecialchars($p['ruta_imagen']) ?>" height="40">
<?php endif; ?>
</td>

<!-- FAVORITO -->
<td>
<?php if (isset($_SESSION['IdUsuario'])): ?>
<?php $esFav = in_array($p['id_producto'], $favoritosIds); ?>
<button class="btn-favorito"
        data-producto="<?= $p['id_producto'] ?>"
        data-fav="<?= $esFav ? 1 : 0 ?>">
    <span class="heart <?= $esFav ? 'is-fav' : '' ?>">♥</span>
</button>
<?php else: ?>
<span>-</span>
<?php endif; ?>
</td>

<!-- ESTADO -->
<?php if ($esAdmin): ?>
<td>
<?php if ($p['estado'] == 1): ?>
<span class="badge bg-success">Activo</span>
<?php else: ?>
<span class="badge bg-danger">Inactivo</span>
<?php endif; ?>
</td>
<?php endif; ?>

<!-- ACCIONES -->
<td>

<?php if (isset($_SESSION['Nombre']) && !$esAdmin): ?>
<?php if ($p['estado'] == 1): ?>
<form class="agregar-carrito-form" data-producto="<?= $p['id_producto'] ?>" style="display:inline-block">
<input type="number" value="1" min="1" class="form-control cantidad-input" style="width:60px; display:inline;">
<button type="button" class="btn btn-sm btn-primary btn-agregar">Agregar</button>
</form>
<?php else: ?>
<span class="text-muted">No disponible</span>
<?php endif; ?>

<?php elseif (!isset($_SESSION['Nombre'])): ?>
<span class="text-muted">Inicia sesión</span>
<?php endif; ?>

<?php if ($esAdmin): ?>

<a href="/ProyectoG8/Views/Producto/editar.php?id=<?= $p['id_producto'] ?>" class="btn btn-sm btn-warning">Editar</a>

<?php if ($p['estado'] == 1): ?>
<form method="post" action="../../Controllers/productoController.php" style="display:inline;">
<input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
<input type="hidden" name="accion" value="eliminar">
<button class="btn btn-sm btn-danger">Desactivar</button>
</form>
<?php else: ?>
<form method="post" action="../../Controllers/productoController.php" style="display:inline;">
<input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
<input type="hidden" name="accion" value="activar">
<button class="btn btn-sm btn-success">Activar</button>
</form>
<?php endif; ?>

<?php endif; ?>

</td>

</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>
</div>
</div>

<?php AddJs(); ?>

<!-- JS -->
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
setTimeout(() => document.getElementById("mensaje-carrito").innerHTML="", 3000);
});
});
});

});
</script>

</body>
</html>
