<?php
session_start();

if (!isset($_SESSION["IdUsuario"]) || !isset($_SESSION["IdRol"])) {
    header("Location: ../Home/login.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/HistorialModel.php';

$usuario = (int) $_SESSION["IdUsuario"];
$rol     = (int) $_SESSION["IdRol"];

// Si es admin → cargar usuarios
$usuarios = [];
if ($rol === 2) {
    $usuarios = ListarUsuariosModel();
}

// Determinar usuario a consultar
if ($rol === 2 && isset($_GET['uid']) && ctype_digit($_GET['uid'])) {
    $uid = (int) $_GET['uid'];
} else {
    $uid = $usuario;
}

// Consultar historial
$compras = [];
$filas = HistorialPorUsuarioModel($uid);

// Agrupar por compra
foreach ($filas as $r) {

    $id = $r['id_compra'];

    if (!isset($compras[$id])) {
        $compras[$id] = [
            'fecha'     => $r['fecha'],
            'total'     => $r['total'],
            'productos' => []
        ];
    }

    $compras[$id]['productos'][] = $r;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial de Compras</title>
<link rel="stylesheet" href="../Estilos/style.css">
<style>
.container{max-width:1000px;margin:20px auto}
table{width:100%;border-collapse:collapse}
td,th{border:1px solid #ccc;padding:6px;text-align:center}
th{background:#f6f6f6}
.muted{color:#777}
</style>
</head>
<body>

<div class="container">

<h2>Historial de Compras</h2>

<?php if ($rol === 2): ?>
<form method="get">
<select name="uid">
<option value="">Seleccione usuario</option>

<?php foreach ($usuarios as $u): ?>
<option value="<?= $u['id_usuario'] ?>" <?= ($u['id_usuario'] == $uid) ? 'selected' : '' ?>>
    <?= htmlspecialchars($u['nombre']) ?> (ID: <?= $u['id_usuario'] ?>)
</option>
<?php endforeach; ?>

</select>
<button type="submit">Ver</button>
</form>
<hr>
<?php endif; ?>

<?php if (!empty($compras)): ?>

<?php foreach ($compras as $id => $c): ?>

<h4>
Compra #<?= $id ?> | <?= $c['fecha'] ?> | Total: ₡<?= number_format($c['total'], 2) ?>
</h4>

<table>
<tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Subtotal</th>
</tr>

<?php foreach ($c['productos'] as $p): ?>
<tr>
<td><?= htmlspecialchars($p['producto']) ?></td>
<td><?= (int) $p['cantidad'] ?></td>
<td>₡<?= number_format($p['precio'], 2) ?></td>
<td>₡<?= number_format($p['precio'] * $p['cantidad'], 2) ?></td>
</tr>
<?php endforeach; ?>

</table>
<br>

<?php endforeach; ?>

<?php else: ?>
<p class="muted">No hay compras registradas.</p>
<?php endif; ?>

<br>
<a href="../Home/principal.php">⬅ Volver al inicio</a>

</div>
</body>
</html>
