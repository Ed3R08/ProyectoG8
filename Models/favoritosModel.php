<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

/* ===============================
   LISTAR FAVORITOS DE USUARIO
================================ */
function ListarFavoritosUsuarioModel($idUsuario)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_FAVORITOS.listar_usuario(:id, :cur); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $idUsuario);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

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

/* ===============================
   AGREGAR FAVORITO
================================ */
function AgregarFavoritoModel($idUsuario, $idProducto)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_FAVORITOS.agregar(:u, :p); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":u", $idUsuario);
        oci_bind_by_name($stmt, ":p", $idProducto);

        $ok = oci_execute($stmt);   // OCI_COMMIT_ON_SUCCESS por defecto
        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}

/* ===============================
   ELIMINAR FAVORITO
================================ */
function EliminarFavoritoModel($idUsuario, $idProducto)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_FAVORITOS.eliminar(:u, :p); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":u", $idUsuario);
        oci_bind_by_name($stmt, ":p", $idProducto);

        $ok = oci_execute($stmt);   // OCI_COMMIT_ON_SUCCESS por defecto
        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}
