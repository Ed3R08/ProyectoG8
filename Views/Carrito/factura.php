<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/ProyectoG8/Models/conexionOracle.php";

if (!isset($_SESSION["IdUsuario"])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION["IdUsuario"];
$conn = conectarOracle();

/* ==========================
   ÚLTIMA COMPRA
========================== */
$sql = "BEGIN sp_ultima_compra_por_usuario(:u, :cur); END;";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":u", $usuarioId);

$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($cursor);

$compra = oci_fetch_assoc($cursor);

if (!$compra) {
    oci_close($conn);
    die("No se encontró ninguna compra registrada.");
}

$compra = array_change_key_case($compra, CASE_LOWER);
$idCompra = $compra['id_compra'];

oci_free_statement($stmt);
oci_free_statement($cursor);

/* ==========================
   DETALLE COMPRA
========================== */
$sql = "BEGIN sp_detalle_compra(:id, :cur); END;";
$stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ":id", $idCompra);

$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($cursor);

$detalles = [];
while ($fila = oci_fetch_assoc($cursor)) {
    $detalles[] = array_change_key_case($fila, CASE_LOWER);
}

oci_free_statement($stmt);
oci_free_statement($cursor);
oci_close($conn);

/* ==========================
   TOTAL
========================== */
$total = 0;
foreach ($detalles as $d) {
    $total += (float)$d['subtotal'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura #<?= htmlspecialchars($idCompra) ?></title>
<style>
body { font-family: Arial; background:#f4f6f9; display:flex; justify-content:center; padding:40px; }
.ticket { background:#fff; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,.1); padding:25px; width:450px; }
h2 { text-align:center; }
.info p { margin:3px 0; }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th { background:#4c90af; color:#fff; padding:8px; font-size:14px; }
td { border-bottom:1px solid #ccc; padding:6px; text-align:center; }
tfoot td { font-weight:bold; }
.total { font-size:16px; }
.boton { margin-top:15px; text-align:center; }
.boton a { background:#4c90af; color:white; padding:8px 15px; text-decoration:none; border-radius:6px; }
</style>
</head>
<body>

<div class="ticket">

<h2>Factura #<?= htmlspecialchars($idCompra) ?></h2>

<div class="info">
    <p><b>Cliente:</b> <?= htmlspecialchars($compra['cliente']) ?></p>
    <p><b>Fecha:</b> <?= htmlspecialchars($compra['fecha']) ?></p>
</div>

<table>
<thead>
<tr><th>Producto</th><th>Cant.</th><th>Precio</th><th>Subtotal</th></tr>
</thead>
<tbody>
<?php foreach ($detalles as $d): ?>
<tr>
<td><?= htmlspecialchars($d['producto']) ?></td>
<td><?= $d['cantidad'] ?></td>
<td>₡<?= number_format($d['precio'],2) ?></td>
<td>₡<?= number_format($d['subtotal'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
<td colspan="3" class="total">TOTAL</td>
<td class="total">₡<?= number_format($total,2) ?></td>
</tr>
</tfoot>
</table>

<div class="boton">
    <a href="../Home/principal.php">Volver al inicio</a>
</div>

</div>
</body>
</html>
