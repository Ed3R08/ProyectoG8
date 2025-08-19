<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';


class CategoriaController
{
    // Muestra formulario de registro
    public static function create(): void
    {
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Categoria/registro.php';
    }

    // Procesa POST de registro
    public static function store(): void
    {
        if (!isset($_POST['descripcion'])) {
            header('Location: registro.php?err=form');
            exit;
        }

        $ok = RegistrarCategoriaModel(
            trim($_POST['descripcion']),
            trim($_POST['ruta_imagen'])
        );

        header('Location: ' . ($ok ? 'registro.php?ok=1' : 'registro.php?err=db'));
        exit;
    }

    // Muestra listado de categorías
    public static function index(): void
    {
        $categorias = ListarCategoriasModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Categoria/listado.php';
    }

    
}
if (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_POST['btnEditarCategoria'])) {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $ruta_imagen = $_POST['ruta_imagen'];
    $activo = isset($_POST['activo']) ? 1 : 0; // Si está chequeado es 1, si no es 0

    $resultado = EditarCategoriaModel($id, $descripcion, $ruta_imagen, $activo);

    if ($resultado) {
        header("Location: ../Views/Categoria/listado.php?msg=Categoría actualizada correctamente");
        exit();
    } else {
        echo "Error al actualizar la categoría.";
    }
}

// ELIMINAR CATEGORÍA
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["accion"]) && $_POST["accion"] === "eliminar") {
        if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
            $id = intval($_POST["id"]);
            $resultado = EliminarCategoriaModel($id);

            if ($resultado) {
                header("Location: ../Views/Categoria/listado.php?msg=categoria_eliminada");
                exit();
            } else {
                echo "Error al eliminar la categoría.";
            }
        } else {
            echo "ID inválido.";
        }
    }
}

