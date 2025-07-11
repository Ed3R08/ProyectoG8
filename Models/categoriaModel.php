<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

function ListarCategoriasModel() {
    try {
        $cn     = OpenDB();
        $result = $cn->query("CALL sp_consulta_categorias()");
        $rows   = $result->fetch_all(MYSQLI_ASSOC);
        CloseDB($cn);
        return $rows;
    }
    catch (Exception $error) {
        RegistrarError($error);
        return [];  // array vacío en caso de falla
    }
}

function RegistrarCategoriaModel($descripcion, $ruta_imagen) {
    try {
        $cn = OpenDB();
        // Escapamos solo los valores
        $desc_esc = $cn->real_escape_string($descripcion);
        $img_esc  = $cn->real_escape_string($ruta_imagen);
        // Construimos el CALL con las comillas fuera del escape
        $sql = "CALL sp_insert_categoria('$desc_esc', '$img_esc')";
        $ok  = $cn->query($sql);
        CloseDB($cn);
        return $ok;
    }
    catch (Exception $error) {
        RegistrarError($error);
        return false;
    }
}

