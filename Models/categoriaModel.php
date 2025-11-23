<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/conexionOracle.php';

/* ============================================================
   LISTAR CATEGORÍAS
   SP Oracle:  sp_consulta_categorias(resultado OUT SYS_REFCURSOR)
============================================================ */
function ListarCategoriasModel()
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN sp_consulta_categorias(:res); END;";
        $stmt = oci_parse($conn, $sql);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":res", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            // Convertir todas las claves a minúsculas
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



/* ============================================================
   REGISTRAR CATEGORÍA
   SP Oracle: sp_insert_categoria(pDesc, pImagen)
============================================================ */
function RegistrarCategoriaModel($descripcion, $ruta_imagen)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN sp_insert_categoria(:d, :img); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":d",   $descripcion);
        oci_bind_by_name($stmt, ":img", $ruta_imagen);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);

        return $ok;
    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   EDITAR CATEGORÍA
   SP Oracle:  EditarCategoria(pId, pDesc, pImagen, pActivo)
============================================================ */
function EditarCategoriaModel($id, $descripcion, $ruta_imagen, $activo)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN EditarCategoria(:id, :d, :img, :act); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id",  $id);
        oci_bind_by_name($stmt, ":d",   $descripcion);
        oci_bind_by_name($stmt, ":img", $ruta_imagen);
        oci_bind_by_name($stmt, ":act", $activo);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);
        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   ELIMINAR CATEGORÍA (Borrado lógico)
   SP Oracle: EliminarCategoria(pId)
============================================================ */
function EliminarCategoriaModel($id)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN EliminarCategoria(:id); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":id", $id);

        $ok = oci_execute($stmt);

        oci_free_statement($stmt);
        oci_close($conn);
        return $ok;

    } catch (Exception $e) {
        return false;
    }
}


/* ============================================================
   LISTAR PRODUCTOS POR CATEGORÍA
   SP Oracle: sp_consulta_productos(pCat, resultado OUT SYS_REFCURSOR)
============================================================ */
function ListarProductosPorCategoriaModel($idCategoria)
{
    try {
        $conn = conectarOracle();
        $sql = "BEGIN sp_consulta_productos(:cat, :res); END;";
        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":cat", $idCategoria);

        $cursor = oci_new_cursor($conn);
        oci_bind_by_name($stmt, ":res", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt);
        oci_execute($cursor);

        $lista = [];
        while ($fila = oci_fetch_assoc($cursor)) {
            $lista[] = $fila;
        }

        oci_free_statement($stmt);
        oci_free_statement($cursor);
        oci_close($conn);

        return $lista;

    } catch (Exception $e) {
        return [];
    }
}

?>
