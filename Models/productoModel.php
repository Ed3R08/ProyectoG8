<?php
// Models/productoModel.php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

/**
 * Normaliza las claves del array a minúsculas
 */
function normalizarFilaOracle($fila)
{
    return array_change_key_case($fila, CASE_LOWER);
}

/* ============================================================
   LISTAR TODOS LOS PRODUCTOS (usa sp_consulta_productos_all)
============================================================ */
function ListarProductosModel()
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN sp_consulta_productos_all(:cur); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $fila = normalizarFilaOracle($fila);

            // Asegurar claves consistentes para la vista
            $fila["existencias"] = $fila["existencias"] ?? $fila["cantidad"] ?? 0;
            $fila["estado"]      = $fila["estado"] ?? 1;

            $lista[] = $fila;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $lista;

    } catch (Exception $e) {
        return [];
    }
}


/* ============================================================
   LISTAR PRODUCTOS POR CATEGORÍA (usa sp_consulta_productos)
============================================================ */
function ListarProductosPorCategoriaModel($idCategoria)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN sp_consulta_productos(:pCat, :pCursor); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":pCat", $idCategoria);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":pCursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $productos = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $fila = normalizarFilaOracle($fila);

            // Normalizar claves requeridas por la vista
            $fila["existencias"] = $fila["existencias"] ?? $fila["cantidad"] ?? 0;
            $fila["estado"]      = $fila["estado"] ?? 1;

            $productos[] = $fila;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $productos;

    } catch (Exception $e) {
        return [];
    }
}


/* ============================================================
   REGISTRAR PRODUCTO (sp_insert_producto)
============================================================ */
function RegistrarProductoModel($idCategoria, $nombre, $detalle, $precio, $existencias, $ruta_imagen)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN sp_insert_producto(:cat, :nom, :det, :pre, :cant, :img); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":cat",  $idCategoria);
        oci_bind_by_name($stmt, ":nom",  $nombre);
        oci_bind_by_name($stmt, ":det",  $detalle);
        oci_bind_by_name($stmt, ":pre",  $precio);
        oci_bind_by_name($stmt, ":cant", $existencias);
        oci_bind_by_name($stmt, ":img",  $ruta_imagen);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   ACTUALIZAR PRODUCTO (EditarProducto)
============================================================ */
function ActualizarProductoModel($idProducto, $idCategoria, $nombre, $detalle, $precio, $existencias, $ruta_imagen)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN EditarProducto(:id, :cat, :nom, :det, :pre, :cant, :img); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id",   $idProducto);
        oci_bind_by_name($stmt, ":cat",  $idCategoria);
        oci_bind_by_name($stmt, ":nom",  $nombre);
        oci_bind_by_name($stmt, ":det",  $detalle);
        oci_bind_by_name($stmt, ":pre",  $precio);
        oci_bind_by_name($stmt, ":cant", $existencias);
        oci_bind_by_name($stmt, ":img",  $ruta_imagen);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   DESACTIVAR PRODUCTO (estado = 0)
============================================================ */
function EliminarProductoModel($idProducto)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN EliminarProducto(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $idProducto);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   ACTIVAR PRODUCTO (estado = 1)
============================================================ */
function ActivarProductoModel($idProducto)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN ActivarProducto(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $idProducto);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}

?>
