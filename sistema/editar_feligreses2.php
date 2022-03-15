<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre'])) {
    $alert = '<p class="alert alert-danger" role="alert">Debe ingresar datos</p>';
  } else {

    $idfeligres =$_POST['id'];
    $cui = $_POST['cui'];
    $nombre = $_POST['nombre'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $idlugar = $_POST['idlugar'];

      $sql_update = mysqli_query($conexion, "UPDATE feligreses SET cui = $cui, nombre = '$nombre', fechanacimiento = '$fechanacimiento', idlugar = '$idlugar' WHERE idfeligres = $idfeligres");

      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';
      } else {
        $alert = '<p class="alert alert-danger" role="alert">Error al actualizar el registro</p>';
      }
    }
  
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_feligreses.php");
}
$idfeligres = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM feligreses WHERE idfeligres = $idfeligres");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_feligreses.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idfeligres = $data['idfeligres'];
    $cui = $data['cui'];
    $nombre = $data['nombre'];
    $fechanacimiento = $data['fechanacimiento'];
    $idlugar = $data['idlugar'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM feligreses WHERE idfeligres ='$idfeligres'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);

    
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_feligreses.php" class="btn btn-primary">Ver listado de registros</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idfeligres; ?>">
               
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="text" placeholder="Ingrese CUI del feligres" name="cui" id="cui" class="form-control" maxlength="15" value="<?php echo $cui; ?>">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre de la feligreses</label>
                    <input type="text" placeholder="Ingrese nombre de la feligreses" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="fechanacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fechanacimiento" id="fechanacimiento" class="form-control" value="<?php echo $fechanacimiento; ?>">
                </div>

                <div class="form-group">
                    <label >Lugar</label>
                    <select name="idlugar" id="idlugar" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM lugar");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idlugar']==$catec['idlugar']){
                                            echo '<option selected="" value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idlugar'].'">'.$catec['nombrelugar'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>


                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Registro</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include_once "includes/footer.php"; ?>