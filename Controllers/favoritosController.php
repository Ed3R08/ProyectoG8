<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['IdUsuario'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión']);
    exit;
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/favoritosModel.php';

$accion = $_GET['accion'] ?? '';
$producto = intval($_POST['producto_id'] ?? 0);
$usuario = intval($_SESSION['IdUsuario']);

if ($producto <= 0) {
    echo json_encode(['success' => false, 'message' => 'Producto inválido']);
    exit;
}

switch ($accion) {
    case 'agregar':
        $ok = AgregarFavoritoModel($usuario, $producto);
        echo json_encode(['success' => $ok]);
        break;

    case 'eliminar':
        $ok = EliminarFavoritoModel($usuario, $producto);
        echo json_encode(['success' => $ok]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Acción inválida']);
}
