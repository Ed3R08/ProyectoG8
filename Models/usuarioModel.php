<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

function ConsultarInfoUsuarioModel($idUsuario)
{
    $conn = conectarOracle();

    $sql = "BEGIN PKG_USUARIOS.consultar(:id, :cur); END;";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":id", $idUsuario);

    $cur = oci_new_cursor($conn);
    oci_bind_by_name($stmt, ":cur", $cur, -1, OCI_B_CURSOR);

    oci_execute($stmt);
    oci_execute($cur);

    $datos = oci_fetch_assoc($cur);
    if ($datos) {
        $datos = array_change_key_case($datos, CASE_UPPER);
    }

    oci_free_statement($stmt);
    oci_free_statement($cur);
    oci_close($conn);

    return $datos ?: [];
}

function ActualizarPerfilUsuarioModel($idUsuario, $nombre, $ap1, $ap2, $correo, $identificacion)
{
    $conn = conectarOracle();

    $sql = "BEGIN PKG_USUARIOS.actualizar(:id, :nom, :ap1, :ap2, :cor, :ident); END;";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":id",    $idUsuario);
    oci_bind_by_name($stmt, ":nom",   $nombre);
    oci_bind_by_name($stmt, ":ap1",   $ap1);
    oci_bind_by_name($stmt, ":ap2",   $ap2);
    oci_bind_by_name($stmt, ":cor",   $correo);
    oci_bind_by_name($stmt, ":ident", $identificacion);

    $ok = @oci_execute($stmt);

    if (!$ok) {
        $error = oci_error($stmt);
        oci_free_statement($stmt);
        oci_close($conn);

        if (!isset($error['message'])) {
            return 'Error al actualizar perfil';
        }

        // LIMPIAR MENSAJE ORACLE
        // Tomar solo lo que viene después de "ORA-xxxxx:"
        if (preg_match('/ORA-\d+:\s*(.*)/', $error['message'], $matches)) {
            return trim($matches[1]);
        }

        return 'Error al actualizar perfil';
    }

    oci_free_statement($stmt);
    oci_close($conn);
    return true;
}
