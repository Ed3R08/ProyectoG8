<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/DireccionModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION['IdUsuario'];
$accion    = $_GET['accion'] ?? '';

switch ($accion) {

    case 'crear':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $provincia = trim($_POST['provincia'] ?? '');
            $canton    = trim($_POST['canton'] ?? '');
            $distrito  = trim($_POST['distrito'] ?? '');
            $detalle   = trim($_POST['detalle'] ?? '');
            $cp        = $_POST['codigo_postal'] ?? null;

            DireccionModel::insertar($usuarioId, $provincia, $canton, $distrito, $detalle, $cp);
        }
        header("Location: ../Views/Direccion/listado.php?msg=Direccion_creada");
        exit;

    case 'actualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST']) {
            $idDir     = intval($_POST['id_direccion'] ?? 0);
            $provincia = trim($_POST['provincia'] ?? '');
            $canton    = trim($_POST['canton'] ?? '');
            $distrito  = trim($_POST['distrito'] ?? '');
            $detalle   = trim($_POST['detalle'] ?? '');
            $cp        = $_POST['codigo_postal'] ?? null;

            if ($idDir > 0) {
                DireccionModel::actualizar($usuarioId, $idDir, $provincia, $canton, $distrito, $detalle, $cp);
            }
        }
        header("Location: ../Views/Direccion/listado.php?msg=Direccion_actualizada");
        exit;

    case 'eliminar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST']) {
            $idDir = intval($_POST['id_direccion'] ?? 0);

            if ($idDir > 0) {
                DireccionModel::eliminar($usuarioId, $idDir);
            }
        }
        header("Location: ../Views/Direccion/listado.php?msg=Direccion_eliminada");
        exit;

    default:
        header("Location: ../Views/Direccion/listado.php");
        exit;
}
?>
