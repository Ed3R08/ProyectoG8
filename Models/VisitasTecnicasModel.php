<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

class VisitasTecnicasModel
{
    public static function programarVisita($idUsuario, $idTipo, $direccionTexto, $motivo)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_VISITAS_TECNICAS.SP_INSERT_VISITA(:u, :t, :fh, :dir, :mot); END;";
            $stmt = oci_parse($conn, $sql);

            $fechaHora = null;

            oci_bind_by_name($stmt, ":u",   $idUsuario);
            oci_bind_by_name($stmt, ":t",   $idTipo);
            oci_bind_by_name($stmt, ":fh",  $fechaHora);
            oci_bind_by_name($stmt, ":dir", $direccionTexto);
            oci_bind_by_name($stmt, ":mot", $motivo);

            $ok = oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;

        } catch (Exception $e) {
            return false;
        }
    }

    public static function listarInformesUsuario($idUsuario)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_VISITAS_TECNICAS.SP_LISTAR_INFORMES_USUARIO(:u, :cur); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":u", $idUsuario);

            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

            oci_execute($stmt);
            oci_execute($cursor);

            $lista = [];

            while ($fila = oci_fetch_assoc($cursor)) {
                $lista[] = array_change_key_case($fila, CASE_LOWER);
            }

            oci_free_statement($stmt);
            oci_free_statement($cursor);
            oci_close($conn);

            return $lista;

        } catch (Exception $e) {
            return [];
        }
    }

    public static function listarVisitasAdmin()
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_VISITAS_TECNICAS.SP_LISTAR_VISITAS_ADMIN(:cur); END;";
            $stmt = oci_parse($conn, $sql);

            $cursor = oci_new_cursor($conn);
            oci_bind_by_name($stmt, ":cur", $cursor, -1, OCI_B_CURSOR);

            oci_execute($stmt);
            oci_execute($cursor);

            $lista = [];

            while ($fila = oci_fetch_assoc($cursor)) {
                $lista[] = array_change_key_case($fila, CASE_LOWER);
            }

            oci_free_statement($stmt);
            oci_free_statement($cursor);
            oci_close($conn);

            return $lista;

        } catch (Exception $e) {
            return [];
        }
    }

    public static function guardarInforme($idVisita, $descripcion)
    {
        try {
            $conn = conectarOracle();

            $sql = "BEGIN PKG_VISITAS_TECNICAS.SP_INSERT_INFORME_TECNICO(:v, :desc); END;";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ":v",    $idVisita);
            oci_bind_by_name($stmt, ":desc", $descripcion);

            $ok = oci_execute($stmt);

            oci_free_statement($stmt);
            oci_close($conn);

            return $ok;

        } catch (Exception $e) {
            return false;
        }
    }
}
?>
