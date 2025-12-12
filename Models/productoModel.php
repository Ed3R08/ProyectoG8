<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

function normalizarFilaOracle($fila)
{
    return array_change_key_case($fila, CASE_LOWER);
}

/* ============================================================
   LISTAR TODOS LOS PRODUCTOS (PACKAGE)
============================================================ */
function ListarProductosModel()
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.listar_all(:cur); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {

            $fila = normalizarFilaOracle($fila);
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
   LISTAR POR CATEGORÍA (PACKAGE)
============================================================ */
function ListarProductosPorCategoriaModel($idCategoria)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.listar_categoria(:cat, :cur); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":cat", $idCategoria);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $productos = [];
        while ($fila = oci_fetch_assoc($cursor)) {

            $fila = normalizarFilaOracle($fila);
            $fila["existencias"] = $fila["existencias"] ?? 0;

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
   INSERTAR PRODUCTO
============================================================ */
function RegistrarProductoModel($cat, $nom, $det, $precio, $exist, $img)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.insertar(:c, :n, :d, :p, :e, :i); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":c", $cat);
        oci_bind_by_name($stmt, ":n", $nom);
        oci_bind_by_name($stmt, ":d", $det);
        oci_bind_by_name($stmt, ":p", $precio);
        oci_bind_by_name($stmt, ":e", $exist);
        oci_bind_by_name($stmt, ":i", $img);

        return oci_execute($stmt);

    } catch (Exception $e) {
        return false;
    }
}

/* ============================================================
   EDITAR PRODUCTO
============================================================ */
function ActualizarProductoModel($id, $cat, $nom, $det, $precio, $exist, $img)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.editar(:id, :c, :n, :d, :p, :e, :i); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);
        oci_bind_by_name($stmt, ":c", $cat);
        oci_bind_by_name($stmt, ":n", $nom);
        oci_bind_by_name($stmt, ":d", $det);
        oci_bind_by_name($stmt, ":p", $precio);
        oci_bind_by_name($stmt, ":e", $exist);
        oci_bind_by_name($stmt, ":i", $img);

        return oci_execute($stmt);

    } catch (Exception $e) {
        return false;
    }
}

/* ============================================================
   DESACTIVAR PRODUCTO
============================================================ */
function EliminarProductoModel($id)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.desactivar(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);

        return oci_execute($stmt);

    } catch (Exception $e) {
        return false;
    }
}

/* ============================================================
   ACTIVAR PRODUCTO
============================================================ */
function ActivarProductoModel($id)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_PRODUCTOS.activar(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);

        return oci_execute($stmt);

    } catch (Exception $e) {
        return false;
    }
}

?>
