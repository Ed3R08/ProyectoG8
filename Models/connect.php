<?php
// /ProyectoG8/Models/connect.php
 
require_once __DIR__ . '/conexionOracle.php';
 
/**
 * Devuelve una conexión OCI a Oracle.
 */
function OpenDB()
{
    return conectarOracle(); // usa tu función que ya probaste
}
 
/**
 * Cierra la conexión OCI.
 */
function CloseDB($cn)
{
    if ($cn) {
        oci_close($cn);
    }
}
 