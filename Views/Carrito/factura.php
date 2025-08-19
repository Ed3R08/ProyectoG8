<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validar usuario
if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION['IdUsuario'];

$conn = OpenDB();

// Traer la última compra del usuario
$sqlUltimaCompra = "SELECT c.id_compra, c.fecha, u.Nombre AS cliente
                    FROM historial_compras c
                    INNER JOIN tusuario u ON c.id_usuario = u.IdUsuario
                    WHERE c.id_usuario = ?
                    ORDER BY c.id_compra DESC 
                    LIMIT 1";
$stmt = $conn->prepare($sqlUltimaCompra);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$compra = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$compra) {
    echo "No se encontró ninguna compra registrada.";
    exit();
}

$idCompra = $compra['id_compra'];

// Traer detalles de esa compra
$sqlDetalles = "SELECT d.cantidad, d.precio, p.nombre AS producto, (d.cantidad * d.precio) AS subtotal
                FROM historial_detalle d
                INNER JOIN producto p ON d.producto_id = p.id_producto
                WHERE d.id_compra = ?";
$stmt = $conn->prepare($sqlDetalles);
$stmt->bind_param("i", $idCompra);
$stmt->execute();
$detalles = $stmt->get_result();
$stmt->close();

CloseDB($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #<?php echo $idCompra; ?></title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .ticket { 
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            padding: 25px;
            width: 480px;
        }

        h2 { 
            text-align: center; 
            margin-bottom: 10px; 
            color: #333;
        }

        .info {
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
        }

        .info p {
            margin: 5px 0;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
        }

        th { 
            background: #4c90afff;
            color: white; 
            padding: 10px; 
            font-size: 14px;
        }

        td { 
            border-bottom: 1px solid #ddd; 
            padding: 8px; 
            text-align: center; 
            font-size: 13px;
        }

        tfoot td {
            font-weight: bold;
            background: #f9f9f9;
        }

        .total {
            font-size: 16px;
            color: #222;
        }

        .boton {
            margin-top: 20px; 
            text-align: center;
        }

        .boton a {
            text-decoration: none;
            background: #4c90afff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .boton a:hover {
            background: #4c90afff;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h2>Factura #<?php echo $idCompra; ?></h2>
        <div class="info">
            <p><strong>Cliente:</strong> <?php echo $compra['cliente']; ?></p>
            <p><strong>Fecha:</strong> <?php echo $compra['fecha']; ?></p>
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
                <?php 
                $total = 0;
                while ($row = $detalles->fetch_assoc()) {
                    $total += $row['subtotal'];
                    echo "<tr>
                            <td>{$row['producto']}</td>
                            <td>{$row['cantidad']}</td>
                            <td>₡".number_format($row['precio'], 2)."</td>
                            <td>₡".number_format($row['subtotal'], 2)."</td>
                          </tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Total</td>
                    <td class="total">₡<?php echo number_format($total, 2); ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="boton">
            <a href="../Home/principal.php">Volver al inicio</a>
        </div>
    </div>
</body>
</html
