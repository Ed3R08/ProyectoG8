<?php
require_once '../../Models/conexionOracle.php';

$conexion = conectarOracle();
echo "✅ ¡Conexión exitosa desde la vista!";
oci_close($conexion);
?>
