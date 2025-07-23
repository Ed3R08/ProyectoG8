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

if (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_POST['btnEditarProducto'])) {
    $id = $_POST['id'];
    $idCategoria = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $ruta_imagen = $_POST['ruta_imagen'];

    $resultado = ActualizarProductoModel($id, $idCategoria, $nombre, $detalle, $precio, $existencias, $ruta_imagen);

    if ($resultado) {
        header("Location: ../Views/Producto/listado.php?msg=Producto actualizado correctamente");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["accion"] === "eliminar") {
        if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
            include_once "../Models/productoModel.php";
            $id = intval($_POST["id"]);
            $resultado = EliminarProductoModel($id);
            if ($resultado) {
                header("Location: ../Views/Producto/listado.php?msg=eliminado");
                exit();
            } else {
                echo "Error al eliminar el producto.";
            }
        } else {
            echo "ID inválido.";
        }
    }
}
