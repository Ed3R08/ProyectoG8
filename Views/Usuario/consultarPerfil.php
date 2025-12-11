<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Controllers/usuarioController.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/favoritosModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idUsuario = $_SESSION["IdUsuario"];
$idRol     = $_SESSION["IdRol"];   // ← NECESARIO PARA OCULTAR COSAS AL ADMIN

$resultado = ConsultarInfoUsuario($idUsuario);
$favoritos = ListarFavoritosUsuarioModel($idUsuario);
?>

<!DOCTYPE html>
<html>
<?php AddCss(); ?>

<body>

<div id="main-wrapper">
    <?php ShowHeader(); ShowMenu(); ?>

    <div class="page-wrapper">
    <div class="container-fluid">

        <!-- ====================================================== -->
        <!-- DATOS DEL PERFIL -->
        <!-- ====================================================== -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Perfil de Usuario</h4>
            </div>

            <hr>

            <form class="form-horizontal" action="" method="POST">
                <div class="card-body">

                    <?php if (isset($_POST["txtMensaje"])): ?>
                        <div class="alert alert-warning text-center"><?= $_POST["txtMensaje"] ?></div>
                    <?php endif; ?>

                    <!-- IDENTIFICACIÓN -->
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Identificación</label>
                        <div class="col-lg-7">
                            <input id="txtIdentificacion" name="txtIdentificacion" type="text"
                                   class="form-control"
                                   value="<?= htmlspecialchars($resultado['IDENTIFICACION']) ?>">
                        </div>
                    </div>

                    <!-- NOMBRE -->
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Nombre</label>
                        <div class="col-md-7">
                            <input id="txtNombre" name="txtNombre" type="text"
                                   class="form-control"
                                   value="<?= htmlspecialchars($resultado['NOMBRE']) ?>">
                        </div>
                    </div>

                    <!-- PRIMER APELLIDO -->
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Primer Apellido</label>
                        <div class="col-md-7">
                            <input id="txtApellido1" name="txtApellido1" type="text"
                                   class="form-control"
                                   value="<?= htmlspecialchars($resultado['APELLIDO1']) ?>">
                        </div>
                    </div>

                    <!-- SEGUNDO APELLIDO -->
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Segundo Apellido</label>
                        <div class="col-md-7">
                            <input id="txtApellido2" name="txtApellido2" type="text"
                                   class="form-control"
                                   value="<?= htmlspecialchars($resultado['APELLIDO2']) ?>">
                        </div>
                    </div>

                    <!-- CORREO -->
                    <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Correo</label>
                        <div class="col-md-7">
                            <input id="txtCorreo" name="txtCorreo" type="email"
                                   class="form-control"
                                   value="<?= htmlspecialchars($resultado['CORREO']) ?>">
                        </div>
                    </div>

                    <!-- BOTÓN -->
                    <div class="row">
                        <div class="col-md-10 text-right pb-2">
                            <button id="btnActualizarPerfilUsuario" name="btnActualizarPerfilUsuario"
                                    class="btn btn-info" type="submit">
                                Procesar
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <!-- ====================================================== -->
        <!-- FAVORITOS DEL USUARIO -->
        <!-- ====================================================== -->
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="card-title">Mis Productos Favoritos</h4>
                <hr>

                <div id="mensaje-favoritos"></div>

                <?php if (empty($favoritos)): ?>
                    <div class="alert alert-info">No tienes productos favoritos.</div>

                <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Imagen</th>

                            <?php if ($idRol != 2): ?>  
                                <th>Cantidad</th>
                            <?php endif; ?>

                            <?php if ($idRol != 2): ?>
                                <th>Comprar</th>
                            <?php endif; ?>

                            <th>Quitar</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($favoritos as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f['nombre']) ?></td>
                            <td>₡<?= number_format($f['precio'], 2) ?></td>

                            <td>
                                <?php if (!empty($f['ruta_imagen'])): ?>
                                    <img src="<?= htmlspecialchars($f['ruta_imagen']) ?>" height="40">
                                <?php endif; ?>
                            </td>

                            <!-- SOLO USUARIO NORMAL VE CANTIDAD -->
                            <?php if ($idRol != 2): ?>
                            <td>
                                <input type="number" class="form-control cant-input"
                                       data-id="<?= $f['id_producto'] ?>"
                                       value="1" min="1" style="width:70px;">
                            </td>
                            <?php endif; ?>

                            <!-- SOLO USUARIO NORMAL VE BOTÓN COMPRAR -->
                            <?php if ($idRol != 2): ?>
                            <td>
                                <button class="btn btn-sm btn-primary btn-agregar"
                                        data-id="<?= $f['id_producto'] ?>">
                                    Agregar
                                </button>
                            </td>
                            <?php endif; ?>

                            <!-- QUITAR FAVORITO (ADMIN Y REGULAR) -->
                            <td>
                                <button class="btn btn-sm btn-danger btn-quitar"
                                        data-id="<?= $f['id_producto'] ?>">
                                    Quitar
                                </button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
                <?php endif; ?>

            </div>
        </div>

    </div>
    </div>

    <?php ShowFooter(); ?>
</div>

<?php AddJs(); ?>

</body>
</html>
