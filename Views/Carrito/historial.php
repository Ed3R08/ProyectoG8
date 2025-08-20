<?php
session_start();

if (!isset($_SESSION["IdUsuario"]) || !isset($_SESSION["IdRol"])) {
    header("Location: ../Home/login.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/HistorialModel.php';

$miUsuarioId = (int) $_SESSION["IdUsuario"];
$miRolId     = (int) $_SESSION["IdRol"];

// Para admin: cargar usuarios en <select>
$usuarios = [];
if ($miRolId === 2) {
    $usuarios = ListarUsuariosModel();
}

// Determinar usuario a consultar
$usuarioConsulta = null;
if ($miRolId === 2) {
    if (isset($_GET['uid']) && ctype_digit($_GET['uid'])) {
        $usuarioConsulta = (int) $_GET['uid'];
    }
} else {
    $usuarioConsulta = $miUsuarioId;
}

// Si hay usuario elegido, traemos historial (detalle) y armamos estructura por compra
$compras = [];
if ($usuarioConsulta !== null) {
    $filas = HistorialPorUsuarioModel($usuarioConsulta);
    foreach ($filas as $row) {
        $idc = $row['id_compra'];
        if (!isset($compras[$idc])) {
            $compras[$idc] = [
                'fecha'     => $row['fecha'],
                'total'     => $row['total'],
                'productos' => []
            ];
        }
        $compras[$idc]['productos'][] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Compras</title>
    <link rel="stylesheet" href="../Estilos/style.css">
    <style>
        .container { max-width: 1000px; margin: 20px auto; }
        .filtros { margin: 10px 0 20px; display: flex; gap: 8px; align-items: center; }
        .compra { padding: 12px 0; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #f6f6f6; }
        .muted { color: #666; }
        a.volver { display:inline-block; margin-top:16px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Historial de Compras</h2>

    <?php if ($miRolId === 2): ?>
        <form class="filtros" method="get" action="historial.php">
            <label for="uid"><strong>Usuario:</strong></label>
            <select name="uid" id="uid">
                <option value="" <?= $usuarioConsulta === null ? 'selected' : '' ?>>(Selecciona un usuario)</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['IdUsuario'] ?>" <?= ($usuarioConsulta === (int) $u['IdUsuario']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($u['Nombre']) ?> (ID: <?= $u['IdUsuario'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ver historial</button>
        </form>
        <hr>
    <?php endif; ?>

    <?php if ($usuarioConsulta === null && $miRolId === 2): ?>
        <p class="muted">Selecciona un usuario para ver su historial.</p>
    <?php else: ?>
        <?php if (!empty($compras)): ?>
            <?php foreach ($compras as $idCompra => $compra): ?>
                <div class="compra">
                    <h4>
                        Compra #<?= $idCompra ?> — <?= $compra['fecha'] ?>
                        | Total: ₡<?= number_format((float) $compra['total'], 2) ?>
                    </h4>
                    <table>
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
                                <td><?= (int)$producto['cantidad'] ?></td>
                                <td>₡<?= number_format((float)$producto['precio'], 2) ?></td>
                                <td>₡<?= number_format((float)$producto['precio'] * (int)$producto['cantidad'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay compras registradas para este usuario.</p>
        <?php endif; ?>
    <?php endif; ?>

    <a class="volver" href="../Home/principal.php">⬅ Volver al inicio</a>
</div>
</body>
</html>
