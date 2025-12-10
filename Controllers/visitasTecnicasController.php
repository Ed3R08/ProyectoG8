<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/VisitasTecnicasModel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../Home/login.php");
    exit();
}

$usuarioId = $_SESSION['IdUsuario'];
$idRol     = $_SESSION['IdRol'] ?? null;
$accion    = $_GET['accion'] ?? '';

switch ($accion) {

    /* ===================================
       PROGRAMAR VISITA (CLIENTE)
    =================================== */
    case 'programar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idTipo   = intval($_POST['id_tipo'] ?? 1);
            $motivo   = trim($_POST['motivo'] ?? '');
            $dirTexto = trim($_POST['direccion_texto'] ?? '');

            if ($dirTexto !== '' && $motivo !== '') {
                VisitasTecnicasModel::programarVisita($usuarioId, $idTipo, $dirTexto, $motivo);
            }
        }
        header("Location: ../Views/Visitas/misVisitas.php?msg=Visita_programada");
        exit;

    /* ===================================
       GUARDAR INFORME (SOLO ADMIN)
    =================================== */
    case 'guardarInforme':
        if ($idRol != 2) { // 2 = admin en tu proyecto
            header("Location: ../Views/Home/principal.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idVisita    = intval($_POST['id_visita'] ?? 0);
            $descripcion = trim($_POST['descripcion'] ?? '');

            if ($idVisita > 0 && $descripcion !== '') {
                VisitasTecnicasModel::guardarInforme($idVisita, $descripcion);
            }
        }

        header("Location: ../Views/Visitas/panelAdmin.php?msg=Informe_guardado");
        exit;

    default:
        header("Location: ../Views/Home/principal.php");
        exit;
}
