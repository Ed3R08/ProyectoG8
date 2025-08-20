<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

// Verificar sesión
if (!isset($_SESSION["IdUsuario"]) || !isset($_SESSION["IdRol"])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = (int)$_SESSION["IdUsuario"];
$conn      = OpenDB();

/* 1) Última compra del usuario via SP */
$compra = null;
if ($stmt = $conn->prepare("CALL sp_ultima_compra_por_usuario(?)")) {
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();
    if ($res = $stmt->get_result()) {
        $compra = $res->fetch_assoc();
        $res->free();
    }
    $stmt->close();
    // Limpiar posibles resultsets pendientes de CALL
    while ($conn->more_results() && $conn->next_result()) { /* no-op */ }
}

if (!$compra) {
    CloseDB($conn);
    echo "No se encontró ninguna compra registrada.";
    exit();
}

$idCompra = (int)$compra['id_compra'];

/* 2) Detalle de la compra via SP */
$detalles = [];
if ($stmt = $conn->prepare("CALL sp_detalle_compra(?)")) {
    $stmt->bind_param("i", $idCompra);
    $stmt->execute();
    if ($res = $stmt->get_result()) {
        while ($row = $res->fetch_assoc()) {
            $detalles[] = $row;
        }
        $res->free();
    }
    $stmt->close();
    while ($conn->more_results() && $conn->next_result()) { /* no-op */ }
}

CloseDB($conn);

// Calcular total
$total = 0.0;
foreach ($detalles as $d) {
    $total += (float)$d['subtotal'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Factura #<?php echo htmlspecialchars($idCompra); ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f4f6f9; display:flex; justify-content:center; padding:40px; }
        .ticket { background:#fff; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,.1); padding:25px; width:480px; }
        h2 { text-align:center; margin-bottom:10px; color:#333; }
        .info { margin-bottom:15px; font-size:14px; color:#555; }
        .info p { margin:5px 0; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        th { background:#4c90af; color:#fff; padding:10px; font-size:14px; }
        td { border-bottom:1px solid #ddd; padding:8px; text-align:center; font-size:13px; }
        tfoot td { font-weight:bold; background:#f9f9f9; }
        .total { font-size:16px; color:#222; }
        .boton { margin-top:20px; text-align:center; }
        .boton a { text-decoration:none; background:#4c90af; color:#fff; padding:10px 20px; border-radius:8px; transition:background .3s; }
        .boton a:hover { background:#3c7c95; }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>Factura #<?php echo htmlspecialchars($idCompra); ?></h2>
        <div class="info">
            <p><strong>Cliente:</strong> <?php echo htmlspecialchars($compra['cliente']); ?></p>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($compra['fecha']); ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['producto']); ?></td>
                        <td><?php echo (int)$row['cantidad']; ?></td>
                        <td>₡<?php echo number_format((float)$row['precio'], 2); ?></td>
                        <td>₡<?php echo number_format((float)$row['subtotal'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Total IVA</td>
                    <td class="total">₡<?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="boton">
            <a href="../Home/principal.php">Volver al inicio</a>
        </div>
    </div>
</body>
</html>
