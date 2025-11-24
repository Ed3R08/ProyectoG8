<?php
// Controllers/ProductoController.php

include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/ProductoModel.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';

class ProductoController
{
    // Mostrar formulario de registro
    public static function create(): void
    {
        $categorias = ListarCategoriasModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Producto/registro.php';
    }

    // Procesar alta de producto
    public static function store(): void
    {
        if (!isset($_POST['categoria'], $_POST['nombre'], $_POST['precio'], $_POST['existencias'])) {
            header('Location: registro.php?err=form');
            exit;
        }

        $idCategoria = intval($_POST['categoria']);
        $nombre      = trim($_POST['nombre']);
        $detalle     = trim($_POST['detalle'] ?? '');
        $precio      = floatval($_POST['precio']);
        $existencias = intval($_POST['existencias']);
        $rutaImagen  = null;

        // === Subida de imagen ===
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

            $dir = $_SERVER["DOCUMENT_ROOT"] . "/ProyectoG8/Uploads/productos/";

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreFinal = uniqid("prod_") . "." . $ext;

            $rutaFisica = $dir . $nombreFinal;
            $rutaWeb    = "/ProyectoG8/Uploads/productos/" . $nombreFinal;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica)) {
                $rutaImagen = $rutaWeb;
            }
        }

        $ok = RegistrarProductoModel(
            $idCategoria,
            $nombre,
            $detalle,
            $precio,
            $existencias,
            $rutaImagen
        );

        header('Location: registro.php?' . ($ok ? 'ok=1' : 'err=db'));
        exit;
    }

    // Listado de productos
    public static function index(): void
    {
        $productos = ListarProductosModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Producto/listado.php';
    }
}

// === EDITAR PRODUCTO ===
if (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_POST['btnEditarProducto'])) {

    $id          = $_POST['id'];
    $idCategoria = $_POST['idCategoria'];
    $nombre      = $_POST['nombre'];
    $detalle     = $_POST['detalle'];
    $precio      = $_POST['precio'];
    $existencias = $_POST['existencias'];

    // Ruta actual enviada en el form
    $ruta_imagen = $_POST['ruta_imagen'] ?? null;

    // Si viene una imagen nueva, la subimos y sustituimos la ruta
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

        $dir = $_SERVER["DOCUMENT_ROOT"] . "/ProyectoG8/Uploads/productos/";

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombreFinal = uniqid("prod_") . "." . $ext;

        $rutaFisica = $dir . $nombreFinal;
        $rutaWeb    = "/ProyectoG8/Uploads/productos/" . $nombreFinal;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica)) {
            $ruta_imagen = $rutaWeb;
        }
    }

    $resultado = ActualizarProductoModel(
        $id,
        $idCategoria,
        $nombre,
        $detalle,
        $precio,
        $existencias,
        $ruta_imagen
    );

    if ($resultado) {
        header("Location: ../Views/Producto/listado.php?msg=Producto actualizado correctamente");
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}

// === ELIMINAR / ACTIVAR PRODUCTO ===
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["accion"])) {

        // DESACTIVAR (estado = 0)
        if ($_POST["accion"] === "eliminar") {
            if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
                $id = intval($_POST["id"]);
                $resultado = EliminarProductoModel($id); // hace estado = 0
                if ($resultado) {
                    header("Location: ../Views/Producto/listado.php?msg=desactivado");
                    exit();
                } else {
                    echo "Error al desactivar el producto.";
                }
            } else {
                echo "ID inválido.";
            }
        }

        // ACTIVAR (estado = 1)
        if ($_POST["accion"] === "activar") {
            if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
                $id = intval($_POST["id"]);
                $resultado = ActivarProductoModel($id);
                if ($resultado) {
                    header("Location: ../Views/Producto/listado.php?msg=activado");
                    exit();
                } else {
                    echo "Error al activar el producto.";
                }
            } else {
                echo "ID inválido.";
            }
        }
    }
}
