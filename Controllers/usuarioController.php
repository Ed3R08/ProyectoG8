<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/usuarioModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/homeModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* ============================================================
    CONSULTAR INFORMACIÓN DEL USUARIO (ORACLE)
============================================================ */
function ConsultarInfoUsuario($idUsuario)
{
    return ConsultarInfoUsuarioModel($idUsuario);
}


/* ============================================================
    ACTUALIZAR PERFIL DE USUARIO
============================================================ */
if (isset($_POST["btnActualizarPerfilUsuario"])) {

    $idUsuario = $_SESSION["IdUsuario"];
    $nombre = $_POST["txtNombre"];
    $correo = $_POST["txtCorreo"];
    $identificacion = $_POST["txtIdentificacion"];

    $resultado = ActualizarPerfilUsuarioModel($idUsuario, $nombre, $correo, $identificacion);

    if ($resultado) {
        $_SESSION["Nombre"] = $nombre;
        $_POST["txtMensaje"] = "Su información se actualizó correctamente.";
    } else {
        $_POST["txtMensaje"] = "Su información NO fue actualizada.";
    }
}

/* ============================================================
    ACTUALIZAR CONTRASEÑA
============================================================ */
if (isset($_POST["btnActualizarContrasenna"])) {

    $idUsuario = $_SESSION["IdUsuario"];
    $actual = $_POST["txtContrasennaAnterior"];
    $nueva = $_POST["txtContrasennaNueva"];
    $confirmar = $_POST["txtConfirmar"];
    $contrasennaSesion = $_SESSION["Contrasenna"];

    if ($contrasennaSesion != $actual) {
        $_POST["txtMensaje"] = "La contraseña anterior no coincide.";
        return;
    }

    if ($nueva != $confirmar) {
        $_POST["txtMensaje"] = "La confirmación no coincide.";
        return;
    }

    $resultado = ActualizarContrasennaModel($idUsuario, $nueva);

    if ($resultado) {
        $_SESSION["Contrasenna"] = $nueva;
        $_POST["txtMensaje"] = "Contraseña actualizada correctamente.";
    } else {
        $_POST["txtMensaje"] = "Error al actualizar la contraseña.";
    }
}
?>
