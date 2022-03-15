<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['idbautismo']) || empty($_POST['idmadrina']) || empty($_POST['idpadrino'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idcomunion = $_POST['id'];

    $partidacm = $_POST['partidacm'];
    $foliocm = $_POST['foliocm'];
    $librocm = $_POST['librocm'];
    $fecha = $_POST['fecha'];
    $idbautismo = $_POST['idbautismo'];
  
    $idmadrina = $_POST['idmadrina'];
    $idpadrino = $_POST['idpadrino'];
    $idministro = $_POST['idministro'];
    $observaciones = $_POST['observaciones'];
    

    $result = 0;
    if (is_numeric($idbautismo) and $idbautismo != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM comunion where (idbautismo = '$idbautismo' AND idcomunion != $idcomunion)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class="alert alert-danger" role="alert">El feligres ya habia sido registrado</p>';

      ?> <a target='_blank' href="constancia_comunion.php?id=<?php echo $result['idcomunion']; ?>">
      <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 
      
    } else {
      if ($idbautismo == '') {
        $idbautismo = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE comunion SET partidacm = '$partidacm', foliocm = '$foliocm', librocm = '$librocm', fecha= '$fecha', idbautismo = '$idbautismo', idmadrina = '$idmadrina', idpadrino = '$idpadrino', idministro = '$idministro', observaciones = '$observaciones' WHERE idcomunion = $idcomunion");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';

        $result2 = 0;
        if (is_numeric($idbautismo) and $idbautismo != 0) {
            $query2 = mysqli_query($conexion, "SELECT * FROM comunion where idbautismo = '$idbautismo'");
            $result2 = mysqli_fetch_array($query2);
        }

        ?> <a target='_blank' href="constancia_comunion.php?id=<?php echo $result2['idcomunion']; ?>">
        <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php


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
$idcomunion = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM comunion WHERE idcomunion = $idcomunion");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_bautismoprueba.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcomunion = $data['idcomunion'];
    $partidacm = $data['partidacm'];
    $foliocm = $data['foliocm'];
    $librocm = $data['librocm'];
    $fecha = $data['fecha'];
    $idbautismo = $data['idbautismo'];
    $idmadrina = $data['idmadrina'];
    $idpadrino = $data['idpadrino'];
    $idministro = $data['idministro'];
    $observaciones = $data['observaciones'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM comunion WHERE idcomunion='$idcomunion'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);
  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Editar datos de constancia de Primera Comunion</h1>
        <a href="lista_primeracomunion.php" class="btn btn-primary">Ver listado comunion</a>
    </div>

    
 
          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idcomunion; ?>">
          
                <div class="form-group">
                    <label for="partidacm">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partidacm" id="partidacm" class="form-control" value="<?php echo $partidacm; ?>">
                </div>
                <div class="form-group">
                    <label for="foliocm">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="foliocm" id="foliocm" class="form-control" value="<?php echo $foliocm; ?>">
                </div>
                <div class="form-group">
                    <label for="librocm">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="librocm" id="librocm" class="form-control" value="<?php echo $librocm; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha para la primera comunion</label>
                    <input type="date" placeholder="Ingrese fecha para la primera comunion" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha; ?>">
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