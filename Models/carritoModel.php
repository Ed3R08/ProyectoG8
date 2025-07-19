<?php
echo "carritoModel cargado correctamente<br>";

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
}
?>
