<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

// Verificar sesión
if (!isset($_SESSION["IdUsuario"])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION["IdUsuario"];
$conn = OpenDB();

// Consultar historial de compras
$sql = "SELECT hc.id_compra, hc.fecha, hc.total,
               hd.producto_id, p.nombre AS producto,
               hd.cantidad, hd.precio
        FROM historial_compras hc
        INNER JOIN historial_detalle hd ON hc.id_compra = hd.id_compra
        INNER JOIN producto p ON p.id_producto = hd.producto_id
        WHERE hc.id_usuario = ?
        ORDER BY hc.fecha DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

$compras = [];
while ($row = $result->fetch_assoc()) {
    $compras[$row['id_compra']]['fecha'] = $row['fecha'];
    $compras[$row['id_compra']]['total'] = $row['total'];
    $compras[$row['id_compra']]['productos'][] = $row;
}

$stmt->close();
CloseDB($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Compras</title>
    <link rel="stylesheet" href="../Estilos/style.css">
</head>
<body>
<div class="container">
    <h2>Historial de Compras</h2>
    <?php if (!empty($compras)): ?>
        <?php foreach ($compras as $idCompra => $compra): ?>
            <div class="compra">
                <h4>Compra #<?= $idCompra ?> - <?= $compra['fecha'] ?> | Total: ₡<?= number_format($compra['total'], 2) ?></h4>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compra['productos'] as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['producto']) ?></td>
                                <td><?= $producto['cantidad'] ?></td>
                                <td>₡<?= number_format($producto['precio'], 2) ?></td>
                                <td>₡<?= number_format($producto['precio'] * $producto['cantidad'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes compras registradas.</p>
    <?php endif; ?>
    <a href="../Home/principal.php">⬅ Volver al inicio</a>
</div>
</body>
</html>
