<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutExterno.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/homeController.php';
?>

<!DOCTYPE html>
<html>
<?php AddCss(); ?>

<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url(../Imagenes/auth-bg.png) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">

                    <div class="logo mb-3">
                        <span class="db"><img src="../Imagenes/logo-icon.jpg" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Registro de Usuarios</h5>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <form class="form-horizontal m-t-20" action="" method="POST">

                                <?php
                                if (isset($_POST["txtMensaje"])) {
                                    echo '<div class="alert alert-warning text-center">' . $_POST["txtMensaje"] . '</div>';
                                }
                                ?>

                                <!-- IDENTIFICACIÓN -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-id-badge"></i></span>
                                    </div>
                                    <input id="txtIdentificacion" name="txtIdentificacion" type="text"
                                        class="form-control form-control-lg" placeholder="Identificación" required>
                                </div>

                                <!-- NOMBRE -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtNombre" name="txtNombre" type="text"
                                        class="form-control form-control-lg" placeholder="Nombre" required>
                                </div>

                                <!-- PRIMER APELLIDO -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtApellido1" name="txtApellido1" type="text"
                                        class="form-control form-control-lg" placeholder="Primer apellido" required>
                                </div>

                                <!-- SEGUNDO APELLIDO -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="txtApellido2" name="txtApellido2" type="text"
                                        class="form-control form-control-lg" placeholder="Segundo apellido" required>
                                </div>

                                <!-- CORREO -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-email"></i></span>
                                    </div>
                                    <input id="txtCorreo" name="txtCorreo" type="email"
                                        class="form-control form-control-lg" placeholder="Correo" required>
                                </div>

                                <!-- CONTRASEÑA -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="txtContrasenna" name="txtContrasenna" type="password"
                                        class="form-control form-control-lg" placeholder="Contraseña" required>
                                </div>

                                <!-- BOTÓN -->
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="btnRegistrarUsuario" name="btnRegistrarUsuario"
                                            class="btn btn-block btn-lg btn-info" type="submit">Procesar</button>
                                    </div>
                                </div>

                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Si ya tienes una cuenta
                                        <a href="login.php" class="text-info m-l-5"><b>Inicia Sesión</b></a>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        Si olvidaste la contraseña
                                        <a href="recuperarAcceso.php" class="text-info m-l-5"><b>Recupera el Acceso</b></a>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php AddJs(); ?>

</body>
</html>
