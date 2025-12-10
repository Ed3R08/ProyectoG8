<?php
 
function conectarOracle() {
    $usuario = 'octavius';
    $contrasena = 'octavius123';
 
    $cadenaConexion = 'host.docker.internal:1521/XEPDB1';
 
    $conexion = oci_connect($usuario, $contrasena, $cadenaConexion, 'AL32UTF8');
 
    if (!$conexion) {
        $e = oci_error();
        die('Error al conectar con Oracle: ' . htmlentities($e['message'], ENT_QUOTES));
    }
 
    return $conexion;
}
