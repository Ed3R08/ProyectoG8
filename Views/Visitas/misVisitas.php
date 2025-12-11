<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['IdUsuario'])) {
    header("Location: ../Home/login.php");
    exit();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/DireccionModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Models/VisitasTecnicasModel.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';

$idUsuario   = $_SESSION['IdUsuario'];
$direcciones = DireccionModel::listarPorUsuario($idUsuario);
$visitas     = VisitasTecnicasModel::listarInformesUsuario($idUsuario);
?>
<!DOCTYPE html>
<html lang="es">
<?php AddCss(); ?>

<body>
<div id="main-wrapper">
<?php ShowHeader(); ShowMenu(); ?>

<div class="page-wrapper">
<div class="container-fluid">

<h3>Visitas técnicas</h3>

<?php if (!empty($_GET['msg'])): ?>
  <div class="alert alert-success">
    <?php echo htmlspecialchars($_GET['msg']); ?>
  </div>
<?php endif; ?>

<!-- FORM PROGRAMAR VISITA -->
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Programar nueva visita técnica</h5>
    <form method="post" action="../../Controllers/visitasTecnicasController.php?accion=programar">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Tipo de servicio</label>
          <select name="id_tipo" class="form-control" required>
            <option value="1">Instalación</option>
            <option value="2">Mantenimiento</option>
            <option value="3">Revisión</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Dirección</label>
          <select name="id_direccion" class="form-control" onchange="updateDireccionTexto(this)" required>
            <option value="">Seleccione una dirección...</option>
            <?php foreach ($direcciones as $dir): 
              $texto = $dir['provincia'] . ' - ' . $dir['canton'] . ' - ' . $dir['distrito'] . ' - ' . $dir['direccion_detallada'];
            ?>
              <option value="<?php echo $dir['id_direccion']; ?>"
                      data-texto="<?php echo htmlspecialchars($texto, ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($texto); ?>
              </option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" name="direccion_texto" id="direccion_texto">
        </div>
        <div class="form-group col-md-4">
          <label>Motivo</label>
          <input type="text" name="motivo" class="form-control" required>
        </div>
      </div>
      <button class="btn btn-primary">Programar visita</button>
    </form>
  </div>
</div>

<script>
function updateDireccionTexto(select) {
  var opt = select.options[select.selectedIndex];
  if (!opt) return;
  var txt = opt.getAttribute('data-texto') || '';
  document.getElementById('direccion_texto').value = txt;
}
</script>

<!-- LISTADO VISITAS + INFORMES -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Historial de visitas</h5>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Visita</th>
          <th>Fecha</th>
          <th>Dirección</th>
          <th>Motivo</th>
          <th>Informe técnico</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($visitas): ?>
        <?php foreach ($visitas as $v): ?>
          <tr>
            <td><?php echo htmlspecialchars($v['id_visita']); ?></td>
            <td><?php echo htmlspecialchars($v['fecha_hora']); ?></td>
            <td><?php echo htmlspecialchars($v['direccion']); ?></td>
            <td><?php echo htmlspecialchars($v['motivo']); ?></td>
            <td><?php echo htmlspecialchars($v['descripcion'] ?? 'Pendiente'); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5">No tienes visitas registradas.</td></tr>
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