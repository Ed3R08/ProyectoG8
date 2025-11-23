<?php
require_once "Models/categoriaModel.php";

$result = RegistrarCategoriaModel("Prueba desde PHP", "/ProyectoG8/Uploads/categorias/test.jpg");

echo $result ? "OK" : "ERROR";
