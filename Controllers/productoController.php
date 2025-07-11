<?php
// Controllers/ProductoController.php

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/ProductoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';

class ProductoController
{
    /**
     * Show the “Alta de Producto” form
     */
    public static function create(): void
    {
        // Cargamos las categorías para el <select>
        $categorias = ListarCategoriasModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Producto/registro.php';
    }

    /**
     * Procesa el POST del formulario de alta
     * Redirige a registro.php?ok=1 o ?err=db
     */
    public static function store(): void
    {
        // Validación básica de formulario
        if (!isset($_POST['categoria'], $_POST['nombre'], $_POST['precio'], $_POST['existencias'])) {
            header('Location: registro.php?err=form');
            exit;
        }

        $ok = RegistrarProductoModel(
            intval($_POST['categoria']),
            trim($_POST['nombre']),
            trim($_POST['detalle'] ?? ''),
            floatval($_POST['precio']),
            intval($_POST['existencias']),
            trim($_POST['ruta_imagen'] ?? '')
        );

        // Redirigimos mostrando éxito o error
        header('Location: registro.php?' . ($ok ? 'ok=1' : 'err=db'));
        exit;
    }

    /**
     * Muestra el listado de productos
     */
    public static function index(): void
    {
        // Obtiene todos los productos
        $productos = ListarProductosModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Producto/listado.php';
    }
}
