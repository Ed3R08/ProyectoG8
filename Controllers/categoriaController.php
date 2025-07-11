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
