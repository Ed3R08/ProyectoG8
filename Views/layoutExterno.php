<?php

function AddCss()
{
    echo
        '<head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">
                <title>Tienda Octavius</title>
                <link href="../Estilos/style.css" rel="stylesheet">
                <link rel="icon" type="image/png" sizes="32x32" href="../Imagenes/favicon.png">

                </head>';
}

function AddJs()
{
    echo
        '<script src="../Funciones/jquery.min.js"></script>
            <script src="../Funciones/popper.min.js"></script>
            <script src="../Funciones/bootstrap.min.js"></script>
            <script src="../Funciones/comunes.js"></script>';
}

?>