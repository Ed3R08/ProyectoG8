<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/usuarioController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idUsuario = $_SESSION["IdUsuario"];
$resultado = ConsultarInfoUsuario($idUsuario);
?>

<!DOCTYPE html>
<html>
<?php AddCss(); ?>

<body>

<div id="main-wrapper">

    <?php
    ShowHeader();
    ShowMenu();
    ?>

    <div class="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Perfil de Usuario</h4>
                        </div>

                        <hr>

                        <form class="form-horizontal" action="" method="POST">
                            <div class="card-body">

                                <?php
                                if (isset($_POST["txtMensaje"])) {
                                    echo '<div class="alert alert-warning text-center">' . $_POST["txtMensaje"] . '</div>';
                                }
                                ?>

                                <!-- IDENTIFICACIÓN -->
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        Identificación
                                    </label>
                                    <div class="col-lg-7">
                                        <input id="txtIdentificacion" name="txtIdentificacion" type="text"
                                               class="form-control form-control-lg"
                                               value="<?= htmlspecialchars($resultado['IDENTIFICACION']) ?>">
                                    </div>
                                </div>

                                <!-- NOMBRE -->
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        Nombre
                                    </label>
                                    <div class="col-md-7">
                                        <input id="txtNombre" name="txtNombre" type="text"
                                               class="form-control form-control-lg"
                                               value="<?= htmlspecialchars($resultado['NOMBRE']) ?>">
                                    </div>
                                </div>

                                <!-- PRIMER APELLIDO -->
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        Primer Apellido
                                    </label>
                                    <div class="col-md-7">
                                        <input id="txtApellido1" name="txtApellido1" type="text"
                                               class="form-control form-control-lg"
                                               value="<?= htmlspecialchars($resultado['APELLIDO1']) ?>">
                                    </div>
                                </div>

                                <!-- SEGUNDO APELLIDO -->
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        Segundo Apellido
                                    </label>
                                    <div class="col-md-7">
                                        <input id="txtApellido2" name="txtApellido2" type="text"
                                               class="form-control form-control-lg"
                                               value="<?= htmlspecialchars($resultado['APELLIDO2']) ?>">
                                    </div>
                                </div>

                                <!-- CORREO -->
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        Correo
                                    </label>
                                    <div class="col-md-7">
                                        <input id="txtCorreo" name="txtCorreo" type="email"
                                               class="form-control form-control-lg"
                                               value="<?= htmlspecialchars($resultado['CORREO']) ?>">
                                    </div>
                                </div>

                                <!-- BOTÓN -->
                                <div class="row">
                                    <div class="col-md-10 text-right pb-2">
                                        <button id="btnActualizarPerfilUsuario" name="btnActualizarPerfilUsuario"
                                                class="btn btn-lg btn-info" type="submit">
                                            Procesar
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

        <?php ShowFooter(); ?>

    </div>

</div>

<?php AddJs(); ?>

</body>
</html>
