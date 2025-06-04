<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso ProyectoG8</title>
    <link href="../Estilos/style.css" rel="stylesheet">
    <style>
    .auth-box {
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        background-color: rgba(255, 255, 255, 0.95);
    }

    .auth-box h3 {
        color: #9b59b6; /* púrpura suave */
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px !important;
    }

    .btn {
        border-radius: 10px !important;
    }
</style>

</head>

<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url(../Imagenes/log.png) no-repeat center center; background-size: cover;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo text-center">
                        <img src="../Imagenes/logo.jpg" alt="logo" style="width: 80px;">
                        <h3 class="m-b-20">Ingreso al Sistema</h3>
                    </div>
                    <form class="form-horizontal m-t-20" id="loginform" action="index.html">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Usuario" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg" placeholder="Contraseña" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="recordar">
                                    <label class="custom-control-label" for="recordar">Recordarme</label>
                                    <a href="#" id="to-recover" class="float-right text-info">¿Olvidaste tu contraseña?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Entrar</button>
                        </div>
                        <div class="text-center">
                            ¿No tienes cuenta? <a href="authentication-register1.html" class="text-info"><b>Regístrate aquí</b></a>
                        </div>
                    </form>
                </div>
                <div id="recoverform" style="display: none;">
                    <div class="logo text-center">
                        <img src="../Imagenes/logo.jpg" alt="logo" style="width: 80px;">
                        <h3 class="m-b-20">Recuperar Contraseña</h3>
                        <p>Escribe tu correo y te enviaremos instrucciones.</p>
                    </div>
                    <form class="m-t-20" action="index.html">
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="email" required placeholder="Correo electrónico">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger btn-lg btn-block" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../Funciones/jquery.min.js"></script>
    <script src="../Funciones/popper.min.js"></script>
    <script src="../Funciones/bootstrap.min.js"></script>
    <script>
        $('#to-recover').on("click", function () {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
</body>

</html>