<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['idbautismo']) || empty($_POST['idmadrina']) || empty($_POST['idpadrino'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idconfirmacion = $_POST['id'];
    $partidacf = $_POST['partidacf'];
    $foliocf = $_POST['foliocf'];
    $librocf = $_POST['librocf'];
    $fecha = $_POST['fecha'];
    $idbautismo = $_POST['idbautismo'];
    $idmadrina = $_POST['idmadrina'];
    $idpadrino = $_POST['idpadrino'];
    $idministro = $_POST['idministro'];
    $observaciones = $_POST['observaciones'];
    

    $result = 0;
    if (is_numeric($idbautismo) and $idbautismo != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM confirmacion where (idbautismo = '$idbautismo' AND idconfirmacion != $idconfirmacion)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class="alert alert-danger" role="alert">El feligres ya habia sido registrado</p>';

          
      ?> <a target='_blank' href="constancia_confirmacion.php?id=<?php echo $result['idconfirmacion']; ?>">
      <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 

    } else {
      if ($idbautismo == '') {
        $idbautismo = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE confirmacion SET partidacf = '$partidacf', foliocf = '$foliocf', librocf = '$librocf', fecha = '$fecha', idbautismo = '$idbautismo', idmadrina = '$idmadrina', idpadrino = '$idpadrino', idministro = '$idministro', observaciones = '$observaciones' WHERE idconfirmacion = $idconfirmacion");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';

        $result2 = 0;
        if (is_numeric($idbautismo) and $idbautismo != 0) {
        $query2 = mysqli_query($conexion, "SELECT * FROM confirmacion where idbautismo = '$idbautismo'");
        $result2 = mysqli_fetch_array($query2);
        }

        ?> <a target='_blank' href="constancia_confirmacion.php?id=<?php echo $result2['idconfirmacion']; ?>">
        <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 


      } else {
        $alert = '<p class="alert alert-danger" role="alert">Error al actualizar el registro</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_confirmacion.php");
}
$idconfirmacion = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM confirmacion WHERE idconfirmacion = $idconfirmacion");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_confirmacion.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idconfirmacion = $data['idconfirmacion'];
    $partidacf = $data['partidacf'];
    $foliocf = $data['foliocf'];
    $librocf = $data['librocf'];
    $fecha = $data['fecha'];
    $idbautismo = $data['idbautismo'];
    $idmadrina = $data['idmadrina'];
    $idpadrino = $data['idpadrino'];
    $idministro = $data['idministro'];
    $observaciones = $data['observaciones'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM confirmacion WHERE idconfirmacion='$idconfirmacion'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);
  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Editar datos de constancia de Confirmacion</h1>
       
        <a href="lista_confirmacion.php" class="btn btn-primary">Ver listado confirmacion</a>
    </div>
 

          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idconfirmacion; ?>">
          
                <div class="form-group">
                    <label for="partidacf">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partidacf" name="partidacf" id="partidacf" class="form-control" value="<?php echo $partidacf; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="foliocf">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de foliocf" name="foliocf" id="foliocf" class="form-control" value="<?php echo $foliocf; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="librocf">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de librocf" name="librocf" id="librocf" class="form-control" value="<?php echo $librocf; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha para la confirmacion</label>
                    <input type="date" placeholder="Ingrese fecha para la primera comunion" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha; ?>"  required pattern="">
                </div>
            
                
                <div class="form-group">
                    <label >Nombre</label>
                    <select name="idbautismo" id="Buscador" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT bautismo.idbautismo as idbautismo, feligreses.nombre as nombre FROM bautismo 
                      join feligreses on bautismo.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idbautismo']==$catec['idbautismo']){
                                            echo '<option selected="" value="'.$catec['idbautismo'].'">'.$catec['nombre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idbautismo'].'">'.$catec['nombre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="Buscador2" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madrina.idmadrina as idmadrina, feligreses.nombre as nombremadrina FROM madrina
                      join feligreses ON madrina.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idmadrina']==$catec['idmadrina']){
                                            echo '<option selected="" value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idmadrina'].'">'.$catec['nombremadrina'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="Buscador3" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padrino.idpadrino as idpadrino, feligreses.nombre as nombrepadrino FROM padrino
                      join feligreses ON padrino.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idpadrino']==$catec['idpadrino']){
                                            echo '<option selected="" value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idpadrino'].'">'.$catec['nombrepadrino'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador3').select2();
                    </Script>
                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="Buscador4" class="form-control">
                   
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
                    <Script>
                    $('#Buscador4').select2();
                    </Script>

                    

              
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