<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

function ConsultarInfoUsuarioModel($idUsuario)
{
    try {
        $conn = conectarOracle();

        // Preparar llamada al procedimiento
        $sql = "BEGIN ConsultarInfoUsuario(:pIdUsuario, :resultado); END;";
        $stmt = oci_parse($conn, $sql);

        // Bind de entrada
        oci_bind_by_name($stmt, ":pIdUsuario", $idUsuario);

        // Cursor de salida
        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":resultado", $cursor, -1, OCI_B_CURSOR);

        // Ejecutar
        oci_execute($stmt);
        oci_execute($cursor);

        // Obtener resultado
        $datos = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $datos;

    } catch (Exception $e) {
        return null;
    }
}

function ActualizarPerfilUsuarioModel($idUsuario, $nombre, $correo, $identificacion)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN ActualizarPerfilUsuario(:idUser, :nom, :cor, :ident); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":idUser", $idUsuario);
        oci_bind_by_name($stmt, ":nom", $nombre);
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
