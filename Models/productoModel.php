<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

function ListarProductosModel($idCategoria = null) {
    try {
        $cn = OpenDB();
        if ($idCategoria !== null) {
            $idCatEsc = $cn->real_escape_string($idCategoria);
            $rs = $cn->query("CALL sp_consulta_productos($idCatEsc)");
        } else {
            // si quieres listar todos sin filtrar, podrías crear otro SP, o reutilizar uno con NULL
            $rs = $cn->query("SELECT p.id_producto, p.nombre, p.detalle, p.precio, p.existencias, p.ruta_imagen 
                                FROM producto p
                               WHERE p.activo = 1
                               ORDER BY p.nombre");
        }
        $rows = $rs->fetch_all(MYSQLI_ASSOC);
        CloseDB($cn);
        return $rows;
    } catch (Exception $e) {
        RegistrarError($e);
        return [];
    }
}

function RegistrarProductoModel($idCategoria, $nombre, $detalle, $precio, $stock, $rutaImagen) {
    try {
        $cn = OpenDB();
        $catEsc    = $cn->real_escape_string($idCategoria);
        $nombreEsc = $cn->real_escape_string($nombre);
        $detEsc    = $cn->real_escape_string($detalle);
        $precioEsc = $cn->real_escape_string($precio);
        $stkEsc    = $cn->real_escape_string($stock);
        $imgEsc    = $cn->real_escape_string($rutaImagen);
        $sql = "CALL sp_insert_producto(
            $catEsc,
            '$nombreEsc',
            '$detEsc',
            $precioEsc,
            $stkEsc,
            '$imgEsc'
        )";
        $ok = $cn->query($sql);
        CloseDB($cn);
        return $ok;
    } catch (Exception $e) {
        RegistrarError($e);
        return false;
    }
}
