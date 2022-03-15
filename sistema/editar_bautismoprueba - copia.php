<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) || empty($_POST['idmadre']) || empty($_POST['idmadrina'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idbautismo = $_POST['id'];
    $cui = $_POST['cui'];
    $partida = $_POST['partida'];
    $folio = $_POST['folio'];
    $libro = $_POST['libro'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $idlugar = $_POST['idlugar'];
    $idmunicipio = $_POST['idmunicipio'];
    $iddepartamento = $_POST['iddepartamento'];
    $idmadre = $_POST['idmadre'];
    $idpadre = $_POST['idpadre'];
    $idmadrina = $_POST['idmadrina'];
    $idpadrino = $_POST['idpadrino'];
    $idministro = $_POST['idministro'];
    $observaciones = $_POST['observaciones'];
    

    $result = 0;
    if (is_numeric($cui) and $cui != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM bautismo where (cui = '$cui' AND idbautismo != $idbautismo)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class="alert alert-danger" role="alert">El CUI ya existe</p>';
    } else {
      if ($cui == '') {
        $cui = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE bautismo SET cui = $cui, partida = '$partida', folio = '$folio', libro = '$libro', nombre = '$nombre', fecha = '$fecha', idlugar = '$idlugar', idmunicipio = '$idmunicipio', iddepartamento = '$iddepartamento', idmadre = '$idmadre', idpadre = '$idpadre', idmadrina = '$idmadrina', idpadrino = '$idpadrino', idministro = '$idministro', observaciones = '$observaciones' WHERE idbautismo = $idbautismo");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';
      } else {
        $alert = '<p class="alert alert-danger" role="alert">Error al actualizar el registro</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_bautismoprueba.php");
}
$idbautismo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM bautismo WHERE idbautismo = $idbautismo");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_bautismoprueba.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idbautismo = $data['idbautismo'];
    $cui = $data['cui'];
    $partida = $data['partida'];
    $folio = $data['folio'];
    $libro = $data['libro'];
    $nombre = $data['nombre'];
    $fecha = $data['fecha'];
    $idlugar = $data['idlugar'];
    $idmunicipio = $data['idmunicipio'];
    $iddepartamento = $data['iddepartamento'];
    $idmadre = $data['idmadre'];
    $idpadre = $data['idpadre'];
    $idmadrina = $data['idmadrina'];
    $idpadrino = $data['idpadrino'];
    $idministro = $data['idministro'];
    $observaciones = $data['observaciones'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM bautismo WHERE idbautismo='$idbautismo'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);
  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
       
        <a href="lista_bautismoprueba.php" class="btn btn-primary">Ver listado bautismo</a>
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
                    <label for="nombre">Nombre del bautizado</label>
                    <input type="text" placeholder="Ingrese nombre del bautizado" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha; ?>">
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

                    <div class="form-group">
                    <label >Municipio</label>
                    <select name="idmunicipio" id="idmunicipio" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM municipio");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idmunicipio']==$catec['idmunicipio']){
                                            echo '<option selected="" value="'.$catec['idmunicipio'].'">'.$catec['nombremunicipio'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idmunicipio'].'">'.$catec['nombremunicipio'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>


                    <div class="form-group">
                    <label >Departamento</label>
                    <select name="iddepartamento" id="iddepartamento" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM departamento");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['iddepartamento']==$catec['iddepartamento']){
                                            echo '<option selected="" value="'.$catec['iddepartamento'].'">'.$catec['nombredepartamento'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['iddepartamento'].'">'.$catec['nombredepartamento'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <div class="form-group">
                    <label >Madre</label>
                    <select name="idmadre" id="idmadre" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM madre");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idmadre']==$catec['idmadre']){
                                            echo '<option selected="" value="'.$catec['idmadre'].'">'.$catec['nombremadre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idmadre'].'">'.$catec['nombremadre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <div class="form-group">
                    <label >Padre</label>
                    <select name="idpadre" id="idpadre" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM padre");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idpadre']==$catec['idpadre']){
                                            echo '<option selected="" value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="idmadrina" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM madrina");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idmadrina']==$catec['idmadrina']){
                                            echo '<option selected="" value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="idpadrino" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM padrino");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idpadrino']==$catec['idpadrino']){
                                            echo '<option selected="" value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="idministro" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM ministro");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idministro']==$catec['idministro']){
                                            echo '<option selected="" value="'.$catec['idministro'].'">'.$catec['nombreministro'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idministro'].'">'.$catec['nombreministro'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    

              
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" placeholder="Ingrese observaciones" name="observaciones" id="observaciones" class="form-control" value="<?php echo $observaciones; ?>">
                </div>


                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Registro</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include_once "includes/footer.php"; ?>