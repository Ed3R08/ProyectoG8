<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario']) || ($_SESSION['IdRol'] ?? null) != 2) {
    header("Location: ../Home/login.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/VisitasTecnicasModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

$visitas = VisitasTecnicasModel::listarVisitasAdmin();

/* ============================
   SEPARAMOS PENDIENTES Y REALIZADAS
============================ */
$pendientes = [];
$realizadas = [];

foreach ($visitas as $v) {
    if (!empty($v['descripcion'])) {
        $realizadas[] = $v;
    } else {
        $pendientes[] = $v;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>

<div class="page-wrapper">
<div class="container-fluid">

<h3>Panel de visitas técnicas (Admin)</h3>

<?php if (!empty($_GET['msg'])): ?>
  <div class="alert alert-success">
    <?= htmlspecialchars($_GET['msg']); ?>
  </div>
<?php endif; ?>


<!-- ===================================================== -->
<!-- ===============   VISITAS PENDIENTES  ================= -->
<!-- ===================================================== -->

<h4 class="mt-4 mb-2">Visitas pendientes</h4>

<div class="card mb-4">
  <div class="card-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Servicio</th>
          <th>Dirección</th>
          <th>Motivo</th>
          <th>Informe técnico</th>
        </tr>
      </thead>
      <tbody>

      <?php if ($pendientes): ?>
        <?php foreach ($pendientes as $v): ?>
          <tr>
            <td><?= htmlspecialchars($v['fecha_hora']); ?></td>
            <td><?= htmlspecialchars($v['nombre_usuario']); ?></td>
            <td><?= htmlspecialchars($v['tipo_servicio']); ?></td>
            <td><?= htmlspecialchars($v['direccion']); ?></td>
            <td><?= htmlspecialchars($v['motivo']); ?></td>

            <td>
              <form method="post" action="../../Controllers/visitasTecnicasController.php?accion=guardarInforme">
                <input type="hidden" name="id_visita" value="<?= $v['id_visita']; ?>">
                <textarea name="descripcion" class="form-control mb-1" rows="2" placeholder="Escriba el informe..." required></textarea>
                <button class="btn btn-sm btn-primary">Guardar informe</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="6">No hay visitas pendientes.</td></tr>
      <?php endif; ?>

      </tbody>
    </table>
  </div>
</div>


<!-- ===================================================== -->
<!-- ===============   VISITAS REALIZADAS  ================= -->
<!-- ===================================================== -->

<h4 class="mt-4 mb-2">Visitas realizadas</h4>

<div class="card">
  <div class="card-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Servicio</th>
          <th>Dirección</th>
          <th>Motivo</th>
          <th>Informe técnico</th>
        </tr>
      </thead>
      <tbody>

      <?php if ($realizadas): ?>
        <?php foreach ($realizadas as $v): ?>
          <tr>
            <td><?= htmlspecialchars($v['fecha_hora']); ?></td>
            <td><?= htmlspecialchars($v['nombre_usuario']); ?></td>
            <td><?= htmlspecialchars($v['tipo_servicio']); ?></td>
            <td><?= htmlspecialchars($v['direccion']); ?></td>
            <td><?= htmlspecialchars($v['motivo']); ?></td>
            <td><?= htmlspecialchars($v['descripcion']); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="6">No hay visitas realizadas.</td></tr>
      <?php endif; ?>

      </tbody>
    </table>
  </div>
</div>

</div>
</div>
</div>

<?php AddJs(); ?>
</body>
</html>
