<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/CategoriaModel.php';

class CategoriaController
{
    // Muestra formulario de registro
    public static function create(): void
    {
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Categoria/registro.php';
    }

    // Registrar categoría
    public static function store(): void
    {
        if (!isset($_POST['descripcion'])) {
            header('Location: registro.php?err=form');
            exit;
        }

        $descripcion = trim($_POST['descripcion']);
        $rutaImagen = null;

        // SUBIR IMAGEN
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

            $dir = $_SERVER["DOCUMENT_ROOT"] . "/ProyectoG8/Uploads/categorias/";

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreFinal = uniqid("cat_") . "." . $ext;

            $rutaFisica = $dir . $nombreFinal;
            $rutaWeb    = "/ProyectoG8/Uploads/categorias/" . $nombreFinal;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica)) {
                $rutaImagen = $rutaWeb;
            }
        }

        $ok = RegistrarCategoriaModel($descripcion, $rutaImagen);

        header('Location: registro.php?' . ($ok ? 'ok=1' : 'err=db'));
        exit;
    }

    // Listar categorías (solo activas para clientes)
    public static function index(): void
    {
        $categorias = ListarCategoriasModel();
        require $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/Categoria/listado.php';
    }
}


/* ============================================================
   EDITAR CATEGORÍA
============================================================ */
if (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_POST['btnEditarCategoria'])) {

    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $ruta_actual = $_POST['ruta_actual'];
    $ruta_nueva = $ruta_actual;

    // Subir nueva imagen si existe
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

        $dir = $_SERVER["DOCUMENT_ROOT"] . "/ProyectoG8/Uploads/categorias/";

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombreFinal = uniqid("cat_") . "." . $ext;

        $rutaFisica = $dir . $nombreFinal;
        $rutaWeb = "/ProyectoG8/Uploads/categorias/" . $nombreFinal;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica)) {
            $ruta_nueva = $rutaWeb;
        }
    }

    // Editar categoría (mantiene estado actual)
    $resultado = EditarCategoriaModel($id, $descripcion, $ruta_nueva, 1);

    if ($resultado) {
        header("Location: ../Views/Categoria/listado.php?msg=Categoria_actualizada");
        exit();
    } else {
        echo "Error al actualizar la categoría.";
    }
}


/* ============================================================
   ELIMINAR / DESACTIVAR CATEGORÍA
============================================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // DESACTIVAR
    if (isset($_POST["accion"]) && $_POST["accion"] === "eliminar") {

        if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
            $id = intval($_POST["id"]);
            $resultado = EliminarCategoriaModel($id);

            if ($resultado) {
                header("Location: ../Views/Categoria/listado.php?msg=categoria_desactivada");
                exit();
            } else {
                echo "Error al desactivar categoría.";
            }
        }
    }

    // ACTIVAR
    if (isset($_POST["accion"]) && $_POST["accion"] === "activar") {

        if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
            $id = intval($_POST["id"]);
            $resultado = ActivarCategoriaModel($id);

            if ($resultado) {
                header("Location: ../Views/Categoria/listado.php?msg=categoria_activada");
                exit();
            } else {
                echo "Error al activar categoría.";
            }
        }
    }
}

