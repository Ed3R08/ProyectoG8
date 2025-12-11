<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';


// ============================================================
// LISTAR SOLO CATEGORÍAS ACTIVAS (PACKAGE)
// ============================================================
function ListarCategoriasModel()
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.listar(:res); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":res", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $lista[] = array_change_key_case($fila, CASE_LOWER);
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $lista;

    } catch (Exception $e) {
        return [];
    }
}


// ============================================================
// LISTAR TODAS LAS CATEGORÍAS (ADMIN) – PACKAGE
// ============================================================
function ListarCategoriasAdminModel()
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.listar_admin(:res); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":res", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $lista[] = array_change_key_case($fila, CASE_LOWER);
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $lista;

    } catch (Exception $e) {
        return [];
    }
}


// ============================================================
// REGISTRAR CATEGORÍA – PACKAGE
// ============================================================
function RegistrarCategoriaModel($descripcion, $ruta_imagen)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.insertar(:d, :img); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":d",   $descripcion);
        oci_bind_by_name($stmt, ":img", $ruta_imagen);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


// ============================================================
// EDITAR CATEGORÍA – PACKAGE
// ============================================================
function EditarCategoriaModel($id, $descripcion, $ruta_imagen, $activo)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.editar(:id, :d, :img, :act); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id",  $id);
        oci_bind_by_name($stmt, ":d",   $descripcion);
        oci_bind_by_name($stmt, ":img", $ruta_imagen);
        oci_bind_by_name($stmt, ":act", $activo);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


// ============================================================
// DESACTIVAR CATEGORÍA – PACKAGE
// ============================================================
function EliminarCategoriaModel($id)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.desactivar(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


// ============================================================
// ACTIVAR CATEGORÍA – PACKAGE
// ============================================================
function ActivarCategoriaModel($id)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN PKG_CATEGORIA.activar(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}

?>
