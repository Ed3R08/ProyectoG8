<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

class DireccionModel
{
    /* ===============================
       LISTAR DIRECCIONES DE USUARIO
    ================================= */
    public static function listarPorUsuario($idUsuario)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_DIRECCION.SP_LISTAR_DIRECCIONES_USUARIO(:u, :cur); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":u", $idUsuario);

            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

            oci_execute($stmt);
            oci_execute($cursor);

            $direcciones = [];
            while ($fila = oci_fetch_assoc($cursor)) {
                $direcciones[] = array_change_key_case($fila, CASE_LOWER);
            }

            oci_free_statement($stmt);
            oci_free_statement($cursor);
            oci_close($conn);

            return $direcciones;
        } catch (Exception $e) {
            return [];
        }
    }

    /* ===============================
       INSERTAR DIRECCIÓN
    ================================= */
    public static function insertar($idUsuario, $provincia, $canton, $distrito, $detalle, $codigoPostal)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_DIRECCION.SP_INSERT_DIRECCION(
                        :u, :prov, :cant, :dist, :det, :cp
                    ); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":u",    $idUsuario);
            oci_bind_by_name($stmt, ":prov", $provincia);
            oci_bind_by_name($stmt, ":cant", $canton);
            oci_bind_by_name($stmt, ":dist", $distrito);
            oci_bind_by_name($stmt, ":det",  $detalle);
            oci_bind_by_name($stmt, ":cp",   $codigoPostal);

            $ok = oci_execute($stmt);
            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;
        } catch (Exception $e) {
            return false;
        }
    }

    /* ===============================
       ACTUALIZAR DIRECCIÓN
    ================================= */
    public static function actualizar($idUsuario, $idDireccion, $provincia, $canton, $distrito, $detalle, $codigoPostal)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_DIRECCION.SP_ACTUALIZAR_DIRECCION(
                        :u, :id, :prov, :cant, :dist, :det, :cp
                    ); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":u",   $idUsuario);
            oci_bind_by_name($stmt, ":id",  $idDireccion);
            oci_bind_by_name($stmt, ":prov",$provincia);
            oci_bind_by_name($stmt, ":cant",$canton);
            oci_bind_by_name($stmt, ":dist",$distrito);
            oci_bind_by_name($stmt, ":det", $detalle);
            oci_bind_by_name($stmt, ":cp",  $codigoPostal);

            $ok = oci_execute($stmt);
            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;
        } catch (Exception $e) {
            return false;
        }
    }

    /* ===============================
       ELIMINAR DIRECCIÓN
    ================================= */
    public static function eliminar($idUsuario, $idDireccion)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_DIRECCION.SP_ELIMINAR_DIRECCION(:u, :id); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":u",  $idUsuario);
            oci_bind_by_name($stmt, ":id", $idDireccion);

            $ok = oci_execute($stmt);
            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;
        } catch (Exception $e) {
            return false;
        }
    }
}
