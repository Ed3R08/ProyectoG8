<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';


/* ============================================================
    REGISTRAR USUARIO
============================================================ */
function RegistrarUsuarioModel($nombre, $apellido1, $apellido2, $correo, $identificacion, $contrasenna)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN RegistrarUsuario(:nom, :ap1, :ap2, :cor, :ident, :pass); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":nom",   $nombre);
        oci_bind_by_name($stmt, ":ap1",   $apellido1);
        oci_bind_by_name($stmt, ":ap2",   $apellido2);
        oci_bind_by_name($stmt, ":cor",   $correo);
        oci_bind_by_name($stmt, ":ident", $identificacion);
        oci_bind_by_name($stmt, ":pass",  $contrasenna);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
    VALIDAR INICIO DE SESIÓN
============================================================ */
function ValidarInicioSesionModel($correo, $contrasenna)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN ValidarInicioSesion(:cor, :pass, :resultado); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":cor", $correo);
        oci_bind_by_name($stmt, ":pass", $contrasenna);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":resultado", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $fila = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $fila;

    } catch (Exception $e) {
        return null;
    }
}


/* ============================================================
    VALIDAR CORREO
============================================================ */
function ValidarCorreoModel($correo)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN ValidarCorreo(:cor, :resultado); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":cor", $correo);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":resultado", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $fila = oci_fetch_assoc($cursor);

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $fila;

    } catch (Exception $e) {
        return null;
    }
}


/* ============================================================
    ACTUALIZAR CONTRASEÑA
============================================================ */
function ActualizarContrasennaModel($idUsuario, $contrasenna)
{
    try {
        $conn = conectarOracle();

        $sql = "BEGIN ActualizarContrasenna(:id, :pass); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id",   $idUsuario);
        oci_bind_by_name($stmt, ":pass", $contrasenna);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;

    } catch (Exception $e) {
        return false;
    }
}

?>
