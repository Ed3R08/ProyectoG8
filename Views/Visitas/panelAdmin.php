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
    <?php echo htmlspecialchars($_GET['msg']); ?>
  </div>
<?php endif; ?>

<div class="card">
  <div class="card-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Visita</th>
          <th>ID Usuario</th>
          <th>ID Tipo</th>
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
            <td><?php echo htmlspecialchars($v['id_usuario']); ?></td>
            <td><?php echo htmlspecialchars($v['id_tipo']); ?></td>
            <td><?php echo htmlspecialchars($v['fecha_hora']); ?></td>
            <td><?php echo htmlspecialchars($v['direccion']); ?></td>
            <td><?php echo htmlspecialchars($v['motivo']); ?></td>
            <td>
              <form method="post" action="../../Controllers/visitasTecnicasController.php?accion=guardarInforme">
                <input type="hidden" name="id_visita" value="<?php echo $v['id_visita']; ?>">
                <textarea name="descripcion" class="form-control mb-1" rows="2" placeholder="Escriba el informe..." required></textarea>
                <button class="btn btn-sm btn-primary">Guardar informe</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="7">No hay visitas registradas.</td></tr>
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