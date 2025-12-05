<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

class CarritoModel
{
    /* ============================================
       AGREGAR PRODUCTO AL CARRITO (PACKAGE)
    ============================================ */
    public static function agregar($usuarioId, $productoId, $cantidad)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_CARRITO.agregar(:u, :p, :c); END;";
            $stmt = oci_parse($conn, $sql);

            $usuarioId  = (int)$usuarioId;
            $productoId = (int)$productoId;
            $cantidad   = (int)$cantidad;

            oci_bind_by_name($stmt, ":u", $usuarioId);
            oci_bind_by_name($stmt, ":p", $productoId);
            oci_bind_by_name($stmt, ":c", $cantidad);

            $ok = oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;

        } catch (Exception $e) {
            return false;
        }
    }

    /* ============================================
       VER CARRITO (PACKAGE)
    ============================================ */
    public static function ver($usuarioId)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_CARRITO.ver(:u, :cur); END;";
            $stmt = oci_parse($conn, $sql);

            $usuarioId = (int)$usuarioId;
            oci_bind_by_name($stmt, ":u", $usuarioId);

            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

            oci_execute($stmt);
            oci_execute($cursor);

            $carrito = [];
            while ($fila = oci_fetch_assoc($cursor)) {
                $carrito[] = array_change_key_case($fila, CASE_LOWER);
            }

            oci_free_statement($stmt);
            oci_free_statement($cursor);
            oci_close($conn);

            return $carrito;

        } catch (Exception $e) {
            return [];
        }
    }

    /* ============================================
       ACTUALIZAR CANTIDAD (PACKAGE)
    ============================================ */
    public static function actualizar($carritoId, $nuevaCantidad)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_CARRITO.actualizar(:id, :cant); END;";
            $stmt = oci_parse($conn, $sql);

            $carritoId     = (int)$carritoId;
            $nuevaCantidad = (int)$nuevaCantidad;

            oci_bind_by_name($stmt, ":id", $carritoId);
            oci_bind_by_name($stmt, ":cant", $nuevaCantidad);

            oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

        } catch (Exception $e) {}
    }

    /* ============================================
       ELIMINAR DEL CARRITO (PACKAGE)
    ============================================ */
    public static function eliminar($carritoId)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_CARRITO.eliminar(:id); END;";
            $stmt = oci_parse($conn, $sql);

            $carritoId = (int)$carritoId;
            oci_bind_by_name($stmt, ":id", $carritoId);

            oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

        } catch (Exception $e) {}
    }

    /* ============================================
       FINALIZAR COMPRA (PACKAGE)
    ============================================ */
    public static function finalizarCompra($usuarioId)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_CARRITO.finalizar(:u); END;";
            $stmt = oci_parse($conn, $sql);

            $usuarioId = (int)$usuarioId;
            oci_bind_by_name($stmt, ":u", $usuarioId);

            $ok = oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;

        } catch (Exception $e) {
            return false;
        }
    }
}
