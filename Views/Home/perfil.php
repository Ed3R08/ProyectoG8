<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil de Usuario</title>
    <link href="../Estilos/style.css" rel="stylesheet">
    <style>
        .perfil-info {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .perfil-info h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .perfil-info .dato {
            font-size: 18px;
            margin: 10px 0;
        }

        .perfil-info .dato span {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
    </style>
</head>

<body>
    <div id="main-wrapper">

        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand">
                        <a href="index.html" class="logo">
                            <b class="logo-icon">
                                <img src="../Imagenes/logo.jpg" alt="logo" class="dark-logo" />
                            </b>
                            <span class="logo-text">
                                <img src="../Imagenes/logo-text.png" alt="texto logo" class="dark-logo" />
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto">
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="#"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../Imagenes/2.jpg" alt="usuario" class="rounded-circle" width="40">
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">Carlos Gomez Castillo <i
                                        class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div><img src="../Imagenes/2.jpg" alt="user" class="rounded-circle" width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">Carlos Gomez Castillo</h4>
                                        <p class=" m-b-0">carlosgo@gmail.com</p>
                                    </div>
                                </div>
                                <div class="profile-dis scrollable">
                                    <a class="dropdown-item" href="perfil.php">
                                        <i class="ti-user m-r-5 m-l-5"></i> Mi perfil</a>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="ti-wallet m-r-5 m-l-5"></i> Mi saldo</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="principal.php"
                                aria-expanded="false">
                                <i class="ti-loop"></i><span class="hide-menu">Volver al inicio</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Mi Perfil</h4>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="perfil-info">
                    <h2>Información del Perfil</h2>
                    <div class="dato"><span>Nombre completo:</span> Carlos Gomez Castillo</div>
                    <div class="dato"><span>Correo electrónico:</span> carlosgo@gmail.com</div>
                    <div class="dato"><span>Teléfono:</span> +506 8888-1234</div>
                    <div class="dato"><span>Dirección:</span> San José, Costa Rica, Barrio La Luz</div>
                </div>
            </div>

            <footer class="footer text-center">
                Trabajo académico
            </footer>
        </div>
    </div>


    <script src="../Funciones/jquery.min.js"></script>
    <script src="../Funciones/popper.min.js"></script>
    <script src="../Funciones/bootstrap.min.js"></script>
    <script src="../Funciones/app.min.js"></script>
    <script src="../Funciones/app.init.js"></script>
    <script src="../Funciones/app-style-switcher.js"></script>
    <script src="../Funciones/perfect-scrollbar.jquery.min.js"></script>
    <script src="../Funciones/sparkline.js"></script>
    <script src="../Funciones/waves.js"></script>
    <script src="../Funciones/sidebarmenu.js"></script>
    <script src="../Funciones/custom.min.js"></script>
</body>

</html>