<?php
function conectarOracle() {
    $usuario = 'octavius';
    $contrasena = 'octavius123';
    $cadenaConexion = 'localhost:1522/XEPDB1';

    $conexion = oci_connect($usuario, $contrasena, $cadenaConexion, 'AL32UTF8');

    if (!$conexion) {
        $e = oci_error();
        die('Error al conectar con Oracle: ' . htmlentities($e['message'], ENT_QUOTES));
    }

    return $conexion;
}
?>
