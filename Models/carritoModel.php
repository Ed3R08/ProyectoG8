<?php


require_once __DIR__ . '/connect.php';

class CarritoModel {
    public static function agregar($usuarioId, $productoId, $cantidad) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_agregar_carrito1(?, ?, ?)");
        $stmt->bind_param("iii", $usuarioId, $productoId, $cantidad);
        $stmt->execute();
        $stmt->close();
        CloseDB($conn);
    }

    public static function ver($usuarioId) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_ver_carrito(?)");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        $carrito = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        CloseDB($conn);
        return $carrito;
    }

    public static function actualizar($carritoId, $nuevaCantidad) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_actualizar_carrito(?, ?)");
        $stmt->bind_param("ii", $carritoId, $nuevaCantidad);
        $stmt->execute();
        $stmt->close();
        CloseDB($conn);
    }

    public static function eliminar($carritoId) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_eliminar_carrito(?)");
        $stmt->bind_param("i", $carritoId);
        $stmt->execute();
        $stmt->close();
        CloseDB($conn);
    }

    public static function obtenerHistorial($usuarioId) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_ver_carrito(?)"); 
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        $historial = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        CloseDB($conn);
        return $historial;
    }

    public static function finalizarCompra($usuarioId) {
        $conn = OpenDB();
        $stmt = $conn->prepare("CALL sp_finalizar_compra(?)");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $conn->query("SELECT LAST_INSERT_ID() as id_compra");
        $row = $result->fetch_assoc();
        $idCompra = $row['id_compra'];
        $stmt->close();
        CloseDB($conn);
        return $idCompra;
    }

    public static function obtenerFactura($idCompra) {
    $conn = OpenDB();

    // Traer datos de la compra
    $stmt = $conn->prepare("SELECT * FROM historial_compras WHERE id_compra = ?");
    $stmt->bind_param("i", $idCompra);
    $stmt->execute();
    $compra = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Traer detalles de la compra
    $stmt = $conn->prepare("
        SELECT d.cantidad, d.precio, p.nombre
        FROM historial_detalle d
        JOIN producto p ON p.id_producto = d.producto_id
        WHERE d.id_compra = ?
    ");
    $stmt->bind_param("i", $idCompra);
    $stmt->execute();
    $detalle = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    CloseDB($conn);

    return [
        'compra' => $compra,
        'detalle' => $detalle
    ];
    }
}
?>
