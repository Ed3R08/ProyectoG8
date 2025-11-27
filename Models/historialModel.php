<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

/* ============================================================
   LISTAR USUARIOS (ADMIN)
============================================================ */
function ListarUsuariosModel()
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN sp_listar_usuarios(:cur); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $usuarios = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $usuarios[] = array_change_key_case($fila, CASE_LOWER);
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $usuarios;

    } catch (Exception $e) {
        return [];
    }
}


/* ============================================================
   HISTORIAL POR USUARIO
============================================================ */
function HistorialPorUsuarioModel($idUsuario)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN sp_historial_usuario(:id, :cur); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $idUsuario);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $historial = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $historial[] = array_change_key_case($fila, CASE_LOWER);
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $historial;

    } catch (Exception $e) {
        return [];
    }
}
