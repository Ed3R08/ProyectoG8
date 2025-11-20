<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/homeModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/utilitariosController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ============================================================
    INICIAR SESIÓN
============================================================ */
if (isset($_POST["btnIniciarSesion"])) {

    $correo = $_POST["txtCorreo"];
    $contrasenna = $_POST["txtContrasenna"];

    $fila = ValidarInicioSesionModel($correo, $contrasenna);

    if ($fila) {
        $_SESSION["Nombre"]      = $fila["NOMBRE"];
        $_SESSION["IdUsuario"]   = $fila["ID_USUARIO"];
        $_SESSION["Contrasenna"] = $fila["CONTRASENA"];
        $_SESSION["IdRol"]       = $fila["ID_ROL"];
        $_SESSION["NombreRol"]   = $fila["NOMBRE_ROL"];

        header("location: ../../Views/Home/principal.php");
        exit();
    } else {
        $_POST["txtMensaje"] = "Correo o contraseña incorrectos.";
    }
}

/* ============================================================
    REGISTRAR NUEVO USUARIO  (SIN API, MANUAL)
============================================================ */
if (isset($_POST["btnRegistrarUsuario"])) {

    $identificacion = trim($_POST["txtIdentificacion"]);
    $nombre         = trim($_POST["txtNombre"]);
    $apellido1      = trim($_POST["txtApellido1"]);
    $apellido2      = trim($_POST["txtApellido2"]);
    $correo         = trim($_POST["txtCorreo"]);
    $contrasenna    = $_POST["txtContrasenna"];

    // Validar campos obligatorios
    if ($identificacion === "" || $nombre === "" || $apellido1 === "" || $apellido2 === "" || $correo === "" || $contrasenna === "") {
        $_POST["txtMensaje"] = "Todos los campos son obligatorios.";
    } else {

        $resultado = RegistrarUsuarioModel($nombre, $apellido1, $apellido2, $correo, $identificacion, $contrasenna);

        if ($resultado) {
            header("location: ../../Views/Home/login.php");
            exit();
        } else {
            $_POST["txtMensaje"] = "El usuario no pudo ser registrado.";
        }
    }
}

/* ============================================================
    RECUPERAR ACCESO (ENVIAR CONTRASEÑA TEMPORAL)
============================================================ */
if (isset($_POST["btnRecuperarAcceso"])) {

    $correo = $_POST["txtCorreo"];
    $fila = ValidarCorreoModel($correo);

    if ($fila) {

        $contrasennaTemporal = generarContrasena();
        $ok = ActualizarContrasennaModel($fila["ID_USUARIO"], $contrasennaTemporal);

        if ($ok) {
            $mensaje = "<html><body>
                        Estimado(a) " . $fila["NOMBRE"] . "<br><br>
                        Nuevo código de acceso: <b>$contrasennaTemporal</b><br>
                        Cámbielo después de ingresar al sistema.
                        </body></html>";

            EnviarCorreo("Recuperar Acceso", $mensaje, $correo);

            header("location: ../../Views/Home/login.php");
            exit();
        }
    }

    $_POST["txtMensaje"] = "No se pudo recuperar el acceso.";
}

/* ============================================================
    CERRAR SESIÓN
============================================================ */
if (isset($_POST["btnCerrarSesion"])) {
    session_destroy();
    header("location: ../../Views/Home/login.php");
    exit();
}
?>
