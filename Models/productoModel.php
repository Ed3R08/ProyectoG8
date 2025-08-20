<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

/**
 * Drena todos los resultsets pendientes de una llamada a CALL ...;
 * Evita "Commands out of sync".
 */
function _drainResults(mysqli $cn)
{
    while ($cn->more_results() && $cn->next_result()) {
        if ($rs = $cn->use_result()) {
            $rs->free();
        }
    }
}

function ListarProductosModel($idCategoria = null)
{
    try {
        $cn = OpenDB();

        if ($idCategoria !== null) {
            $idCat = (int) $idCategoria;
            $rs = $cn->query("CALL sp_consulta_productos($idCat)");
        } else {
            $rs = $cn->query("CALL sp_consulta_productos_all()");
        }

        $rows = [];
        if ($rs) {
            $rows = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
        }
        _drainResults($cn);
        CloseDB($cn);
        return $rows;
    } catch (Exception $e) {
        RegistrarError($e);
        return [];
    }
}

function RegistrarProductoModel($idCategoria, $nombre, $detalle, $precio, $stock, $rutaImagen)
{
    try {
        $cn = OpenDB();
        $cat = (int) $idCategoria;
        $nom = $cn->real_escape_string($nombre);
        $det = $cn->real_escape_string($detalle);
        $precioVal = (float) $precio;
        $stk = (int) $stock;
        $img = $cn->real_escape_string((string) $rutaImagen);

        $sql = "CALL sp_insert_producto($cat, '$nom', '$det', $precioVal, $stk, '$img')";
        $ok = $cn->query($sql);

        _drainResults($cn);
        CloseDB($cn);
        return (bool) $ok;
    } catch (Exception $e) {
        RegistrarError($e);
        return false;
    }
}

function ActualizarProductoModel($id, $idCategoria, $nombre, $detalle, $precio, $existencias, $ruta_imagen)
{
    try {
        $cn = OpenDB();
        $idProd = (int) $id;
        $idCat = (int) $idCategoria;
        $nom = $cn->real_escape_string($nombre);
        $det = $cn->real_escape_string($detalle);
        $precioVal = (float) $precio;
        $existVal = (int) $existencias;
        $ruta = $cn->real_escape_string((string) $ruta_imagen);

        $sql = "CALL EditarProducto($idProd, $idCat, '$nom', '$det', $precioVal, $existVal, '$ruta')";
        $ok = $cn->query($sql);
        if (!$ok) {
            throw new Exception("Error MySQL: " . $cn->error);
        }

        _drainResults($cn);
        CloseDB($cn);
        return true;
    } catch (Exception $error) {
        RegistrarError($error);
        return false;
    }
}

function EliminarProductoModel($id)
{
    try {
        $cn = OpenDB();
        $idProd = (int) $id;
        $ok = $cn->query("CALL EliminarProducto($idProd)");
        _drainResults($cn);
        CloseDB($cn);
        return (bool) $ok;
    } catch (Exception $e) {
        RegistrarError($e);
        return false;
    }
}
