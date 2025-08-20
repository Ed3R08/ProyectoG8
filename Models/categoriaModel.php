<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

function ListarCategoriasModel()
{
    try {
        $cn = OpenDB();
        $result = $cn->query("CALL sp_consulta_categorias()");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        CloseDB($cn);
        return $rows;
    } catch (Exception $error) {
        RegistrarError($error);
        return [];  // array vacío en caso de falla
    }
}

function RegistrarCategoriaModel($descripcion, $ruta_imagen)
{
    try {
        $cn = OpenDB();
        // Escapamos solo los valores
        $desc_esc = $cn->real_escape_string($descripcion);
        $img_esc = $cn->real_escape_string($ruta_imagen);
        // Construimos el CALL con las comillas fuera del escape
        $sql = "CALL sp_insert_categoria('$desc_esc', '$img_esc')";
        $ok = $cn->query($sql);
        CloseDB($cn);
        return $ok;
    } catch (Exception $error) {
        RegistrarError($error);
        return false;
    }
}

function EditarCategoriaModel($id, $descripcion, $ruta_imagen, $activo)
{
    try {
        $cn = OpenDB();

        // Escapamos valores
        $id_esc = intval($id);
        $desc_esc = $cn->real_escape_string($descripcion);
        $img_esc = $cn->real_escape_string($ruta_imagen);
        $act_esc = intval($activo);

        // Construimos la llamada al SP
        $sql = "CALL EditarCategoria($id_esc, '$desc_esc', '$img_esc', $act_esc)";
        $ok = $cn->query($sql);

        CloseDB($cn);
        return $ok;
    } catch (Exception $error) {
        RegistrarError($error);
        return false;
    }
}

function EliminarCategoriaModel($id)
{
    try {
        $cn = OpenDB();

        $id_esc = intval($id);

        // Borrado lógico (usa tu SP EliminarCategoria)
        $sql = "CALL EliminarCategoria($id_esc)";
        $ok = $cn->query($sql);

        CloseDB($cn);
        return $ok;
    } catch (Exception $error) {
        RegistrarError($error);
        return false;
    }
}

function ListarProductosPorCategoriaModel($idCategoria) {
    try {
        $cn = OpenDB();
        $id_esc = intval($idCategoria);
        $sql = "CALL sp_consulta_productos($id_esc)";
        $result = $cn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        CloseDB($cn);
        return $rows;
    } catch (Exception $error) {
        RegistrarError($error);
        return [];
    }
}


