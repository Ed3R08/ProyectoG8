<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

/* ============================
   REGISTRAR USUARIO
============================ */
function RegistrarUsuarioModel($nombre, $ap1, $ap2, $correo, $ident, $pass)
{
    $conn = conectarOracle();

    $sql = "BEGIN PKG_USUARIOS.registrar(:nom, :ap1, :ap2, :cor, :ident, :pass); END;";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":nom",   $nombre);
    oci_bind_by_name($stmt, ":ap1",   $ap1);
    oci_bind_by_name($stmt, ":ap2",   $ap2);
    oci_bind_by_name($stmt, ":cor",   $correo);
    oci_bind_by_name($stmt, ":ident", $ident);
    oci_bind_by_name($stmt, ":pass",  $pass);

    $ok = @oci_execute($stmt);

    if (!$ok) {
        $err = oci_error($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        if (!isset($err['message'])) {
            return 'Error al registrar usuario';
        }

        // ✅ Limpiar mensaje Oracle (solo texto humano)
        if (preg_match('/ORA-\d+:\s*(.*)/', $err['message'], $matches)) {
            return trim($matches[1]);
        }

        return 'Error al registrar usuario';
    }

    oci_free_statement($stmt);
    oci_close($conn);
    return true;
}

/* ============================
   LOGIN
============================ */
function ValidarInicioSesionModel($correo, $pass)
{
    $conn = conectarOracle();

    $sql = "BEGIN PKG_USUARIOS.login(:cor, :pass, :cur); END;";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":cor", $correo);
    oci_bind_by_name($stmt, ":pass", $pass);

    $cur = oci_new_cursor($conn);
    oci_bind_by_name($stmt, ":cur", $cur, -1, OCI_B_CURSOR);

    oci_execute($stmt);
    oci_execute($cur);

    $fila = oci_fetch_assoc($cur);

    oci_free_statement($stmt);
    oci_free_statement($cur);
    oci_close($conn);

    return $fila ?: null;
}

/* ============================
   CORREO EXISTENTE
============================ */
function ValidarCorreoModel($correo)
{
    $conn = conectarOracle();

    $sql = "SELECT id_usuario, nombre FROM usuarios WHERE correo = :cor";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":cor", $correo);

    oci_execute($stmt);
    $fila = oci_fetch_assoc($stmt);

    oci_free_statement($stmt);
    oci_close($conn);

    return $fila ?: null;
}

/* ============================
   ACTUALIZAR CONTRASEÑA
============================ */
function ActualizarContrasennaModel($id, $pass)
{
    $conn = conectarOracle();

    $sql = "UPDATE usuarios SET contrasena = :pass WHERE id_usuario = :id";
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":pass", $pass);
    oci_bind_by_name($stmt, ":id", $id);

    $ok = oci_execute($stmt);

    oci_free_statement($stmt);
    oci_close($conn);
    return $ok;
}
