<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/connect.php';

function _drainResults_hist(mysqli $cn) {
    while ($cn->more_results() && $cn->next_result()) {
        if ($rs = $cn->use_result()) { $rs->free(); }
    }
}

/** Solo para admin: lista de usuarios para el <select> */
function ListarUsuariosModel() {
    try {
        $cn = OpenDB();
        $rs = $cn->query("CALL sp_listar_usuarios()");
        $rows = [];
        if ($rs) {
            $rows = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
        }
        _drainResults_hist($cn);
        CloseDB($cn);
        return $rows;
    } catch (Exception $e) {
        RegistrarError($e);
        return [];
    }
}

/** Trae las filas (detalladas) del historial de un usuario */
function HistorialPorUsuarioModel($usuarioId) {
    try {
        $cn  = OpenDB();
        $uid = (int)$usuarioId;
        $rs  = $cn->query("CALL sp_historial_usuario($uid)");
        $rows = [];
        if ($rs) {
            $rows = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
        }
        _drainResults_hist($cn);
        CloseDB($cn);
        return $rows;
    } catch (Exception $e) {
        RegistrarError($e);
        return [];
    }
}
