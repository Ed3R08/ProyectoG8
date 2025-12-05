<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

function ConsultarInfoUsuarioModel($idUsuario)
{
    try {
        $conn = conectarOracle();

        // Llamada al procedimiento
        $sql = "BEGIN pkG_USUARIOS.consultar(:pIdUsuario, :resultado); END;";
        $stmt = oci_parse($conn, $sql);

        // Bind input
        oci_bind_by_name($stmt, ":pIdUsuario", $idUsuario);

        // Cursor de salida
        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":resultado", $cursor, -1, OCI_B_CURSOR);

        // Ejecutar
        oci_execute($stmt);
        oci_execute($cursor);

        // Traer una fila
        $datos = oci_fetch_assoc($cursor);

        // Convertir claves a mayúscula garantizada
        if ($datos) {
            $datos = array_change_key_case($datos, CASE_UPPER);
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $datos;

    } catch (Exception $e) {
        return [];
    }
}

function ActualizarPerfilUsuarioModel($idUsuario, $nombre, $ap1, $ap2, $correo, $identificacion)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN PKG_USUARIOS.actualizar(:idUser, :nom, :ap1, :ap2, :cor, :ident); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":idUser", $idUsuario);
        oci_bind_by_name($stmt, ":nom", $nombre);
        oci_bind_by_name($stmt, ":ap1", $ap1);
        oci_bind_by_name($stmt, ":ap2", $ap2);
        oci_bind_by_name($stmt, ":cor", $correo);
        oci_bind_by_name($stmt, ":ident", $identificacion);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}
?>
