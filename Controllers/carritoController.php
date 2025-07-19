<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/carritoModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validar que el usuario esté logueado y no sea administrador
if (!isset($_SESSION['Nombre']) || !isset($_SESSION['IdRol']) || $_SESSION['IdRol'] == 2) {
    header("Location: ../Home/login.php");
    exit();
}

$usuario_id = $_SESSION['IdUsuario'] ?? null;

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $producto_id = $_POST['producto_id'] ?? null;
        $cantidad = $_POST['cantidad'] ?? 1;

        if ($producto_id && $usuario_id) {
            CarritoModel::agregar($usuario_id, $producto_id, $cantidad);
        }
        header("Location: ../Views/Carrito/verCarrito.php");
        break;

    case 'actualizar':
        $carrito_id = $_POST['carrito_id'] ?? null;
        $nueva_cantidad = $_POST['nueva_cantidad'] ?? 1;

        if ($carrito_id) {
            CarritoModel::actualizar($carrito_id, $nueva_cantidad);
        }
        header("Location: ../Carrito/verCarrito.php");
        break;

    case 'eliminar':
        $carrito_id = $_POST['carrito_id'] ?? null;

        if ($carrito_id) {
            CarritoModel::eliminar($carrito_id);
        }
        header("Location: ../Carrito/verCarrito.php");
        break;

    default:
        header("Location: ../Home/principal.php");
        break;
}
