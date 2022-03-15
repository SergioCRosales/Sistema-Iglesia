<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['bautizado']) || empty($_POST['madre']) || empty($_POST['madrina'])) {
    $alert = '<p class"error">Todo los campos son requeridos</p>';
  } else {
    $idbautismo = $_POST['id'];
    $cui = $_POST['cui'];
    $partida = $_POST['partida'];
    $folio = $_POST['folio'];
    $libro = $_POST['libro'];
    $bautizado = $_POST['bautizado'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $lugar = $_POST['lugar'];
    $municipio = $_POST['municipio'];
    $departamento = $_POST['departamento'];
    $madre = $_POST['madre'];
    $padre = $_POST['padre'];
    $madrina = $_POST['madrina'];
    $padrino = $_POST['padrino'];
    $ministro = $_POST['ministro'];
    $observaciones = $_POST['observaciones'];

    $result = 0;
    if (is_numeric($cui) and $cui != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM bautismos where (cui = '$cui' AND idbautismo != $idbautismo)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El CUI ya existe</p>';
    } else {
      if ($cui == '') {
        $cui = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE bautismos SET cui = $cui, partida = '$partida', folio = '$folio', libro = '$libro', bautizado = '$bautizado', fecha_nacimiento = '$fecha_nacimiento', lugar = '$lugar', municipio = '$municipio', departamento = '$departamento', madre = '$madre', padre = '$padre', madrina = '$madrina', padrino = '$padrino', ministro = '$ministro', observaciones = '$observaciones' WHERE idbautismo = $idbautismo");

      if ($sql_update) {
        $alert = '<p class"exito">Registro actualizado correctamente</p>';
      } else {
        $alert = '<p class"error">Error al actualizar el registro</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_bautismo.php");
}
$idbautismo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM bautismos WHERE idbautismo = $idbautismo");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_bautismo.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idbautismo = $data['idbautismo'];
    $cui = $data['cui'];
    $partida = $data['partida'];
    $folio = $data['folio'];
    $libro = $data['libro'];
    $bautizado = $data['bautizado'];
    $fecha_nacimiento = $data['fecha_nacimiento'];
    $lugar = $data['lugar'];
    $municipio = $data['municipio'];
    $departamento = $data['departamento'];
    $madre = $data['madre'];
    $padre = $data['padre'];
    $madrina = $data['madrina'];
    $padrino = $data['padrino'];
    $ministro = $data['ministro'];
    $observaciones = $data['observaciones'];
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_bautismo.php" class="btn btn-primary">Ver listado bautismo</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idbautismo; ?>">
               
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="number" placeholder="Ingrese CUI del bautizado" name="cui" id="cui" class="form-control" value="<?php echo $cui; ?>">
                </div>
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" class="form-control" value="<?php echo $partida; ?>">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" class="form-control" value="<?php echo $folio; ?>">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" class="form-control" value="<?php echo $libro; ?>">
                </div>
                <div class="form-group">
                    <label for="bautizado">Nombre del bautizado</label>
                    <input type="text" placeholder="Ingrese nombre del bautizado" name="bautizado" id="bautizado" class="form-control" value="<?php echo $bautizado; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento; ?>">
                </div>
                <div class="form-group">
                    <label for="lugar">Lugar</label>
                    <input type="text" placeholder="Ingrese lugar" name="lugar" id="lugar" class="form-control" value="<?php echo $lugar; ?>">
                </div>
                <div class="form-group">
                    <label for="municipio">Municipio</label>
                    <input type="text" placeholder="Ingrese municipio" name="municipio" id="municipio" class="form-control" value="<?php echo $municipio; ?>">
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <input type="text" placeholder="Ingrese departamento" name="departamento" id="partamento" class="form-control" value="<?php echo $departamento; ?>">
                </div>
                <div class="form-group">
                    <label for="madre">Madre</label>
                    <input type="text" placeholder="Ingrese nombre de la madre" name="madre" id="madre" class="form-control" value="<?php echo $madre; ?>">
                </div>
                <div class="form-group">
                    <label for="padre">Padre</label>
                    <input type="text" placeholder="Ingrese nombre del padre" name="padre" id="padre" class="form-control" value="<?php echo $padre; ?>">
                </div>
                <div class="form-group">
                    <label for="madrina">Madrina</label>
                    <input type="text" placeholder="Ingrese nombre de la madrina" name="madrina" id="madrina" class="form-control" value="<?php echo $madrina; ?>">
                </div>
                <div class="form-group">
                    <label for="padrino">Padrino</label>
                    <input type="text" placeholder="Ingrese nombre del padrino" name="padrino" id="padrino" class="form-control" value="<?php echo $padrino; ?>">
                </div>
                <div class="form-group">
                    <label for="ministro">Ministro</label>
                    <input type="text" placeholder="Ingrese nombre del ministro" name="ministro" id="ministro" class="form-control" value="<?php echo $ministro; ?>">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" placeholder="Ingrese observaciones" name="observaciones" id="observaciones" class="form-control" value="<?php echo $observaciones; ?>">
                </div>


                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Registro</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include_once "includes/footer.php"; ?>