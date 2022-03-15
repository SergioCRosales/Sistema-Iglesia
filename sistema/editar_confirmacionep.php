<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['idfeligres']) || empty($_POST['idmadrina']) || empty($_POST['idpadrino'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idconfirmacion = $_POST['id'];
    $partida = $_POST['partida'];
    $folio = $_POST['folio'];
    $libro = $_POST['libro'];
    $fecha = $_POST['fecha'];
    $idfeligres = $_POST['idfeligres'];
    $fechabautismo = $_POST['fechabautismo'];
    $idmadre = $_POST['idmadre'];
    $idpadre = $_POST['idpadre'];
    $idmadrina = $_POST['idmadrina'];
    $idpadrino = $_POST['idpadrino'];
    $idministro = $_POST['idministro'];
    $observaciones = $_POST['observaciones'];
    

    $result = 0;
    if (is_numeric($idfeligres) and $idfeligres != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM confirmacionep where (idfeligres = '$idfeligres' AND idconfirmacion != $idconfirmacion)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class="alert alert-danger" role="alert">El feligres ya habia sido registrado</p>';
      
      
      ?> <a target='_blank' href="constancia_confirmacionep.php?id=<?php echo $result['idconfirmacion']; ?>">
      <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 
       
    } else {
      if ($idfeligres == '') {
        $idfeligres = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE confirmacionep SET partida = '$partida', folio = '$folio', libro = '$libro', fecha = '$fecha', idfeligres = '$idfeligres', fechabautismo = '$fechabautismo', idmadre = '$idmadre', idpadre = '$idpadre', idmadrina = '$idmadrina', idpadrino = '$idpadrino', idministro = '$idministro', observaciones = '$observaciones' WHERE idconfirmacion = $idconfirmacion");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';

        $result2 = 0;
        if (is_numeric($idfeligres) and $idfeligres != 0) {
            $query2 = mysqli_query($conexion, "SELECT * FROM confirmacionep where idfeligres = '$idfeligres'");
            $result2 = mysqli_fetch_array($query2);
        }

        ?> <a target='_blank' href="constancia_confirmacionep.php?id=<?php echo $result2['idconfirmacion']; ?>">
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
$idconfirmacion = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM confirmacionep WHERE idconfirmacion = $idconfirmacion");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_bautismoprueba.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idconfirmacion = $data['idconfirmacion'];
    $partida = $data['partida'];
    $folio = $data['folio'];
    $libro = $data['libro'];
    $fecha = $data['fecha'];
    $idfeligres = $data['idfeligres'];
    $fechabautismo = $data['fechabautismo'];
    $idmadre = $data['idmadre'];
    $idpadre = $data['idpadre'];
    $idmadrina = $data['idmadrina'];
    $idpadrino = $data['idpadrino'];
    $idministro = $data['idministro'];
    $observaciones = $data['observaciones'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM confirmacionep WHERE idconfirmacion='$idconfirmacion'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);
  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Editar de constancia de Confirmacion (Origiario de otra parroquia)</h1>
       
        <a href="lista_confirmacionep.php" class="btn btn-primary">Ver listado confirmacion</a>
    </div>
 

          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idconfirmacion; ?>">
          
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" class="form-control" value="<?php echo $partida; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" class="form-control" value="<?php echo $folio; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" class="form-control" value="<?php echo $libro; ?>"  required pattern="^[0-9]{10}$">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha para la confirmacion</label>
                    <input type="date" placeholder="Ingrese fecha para confirmacion" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha; ?>"  required pattern="">
                </div>
            
                
                <div class="form-group">
                    <label >Nombre</label>
                    <select name="idfeligres" id="Buscador" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * from feligresesep");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idfeligres']==$catec['idfeligres']){
                                            echo '<option selected="" value="'.$catec['idfeligres'].'">'.$catec['nombre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idfeligres'].'">'.$catec['nombre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>
                    <div class="form-group">
                    <label for="fechabautismo">Fecha en que fue bautizado</label>
                    <input type="date" placeholder="Ingrese fecha para confirmacion" name="fechabautismo" id="fechabautismo" class="form-control" value="<?php echo $fechabautismo; ?>"  required pattern="">
                </div>

                <div class="form-group">
                    <label >Madre</label>
                    <select name="idmadre" id="Buscador2" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madreep.idmadre as idmadre, feligresesep.nombre as nombremadre FROM madreep
                      join feligresesep ON madreep.idfeligreses = feligresesep.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idmadre']==$catec['idmadre']){
                                            echo '<option selected="" value="'.$catec['idmadre'].'">'.$catec['nombremadre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idmadre'].'">'.$catec['nombremadre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <div class="form-group">
                    <label >Padre</label>
                    <select name="idpadre" id="Buscador3" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padreep.idpadre as idpadre, feligresesep.nombre as nombrepadre FROM padreep
                      join feligresesep ON padreep.idfeligreses = feligresesep.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idpadre']==$catec['idpadre']){
                                            echo '<option selected="" value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idpadre'].'">'.$catec['nombrepadre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                  
                    <Script>
                    $('#Buscador3').select2();
                    </Script>

                    <div class="form-group">
                    <label >Madrina</label>
                    <select name="idmadrina" id="Buscador4" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT madrinaep.idmadrina as idmadrina, feligresesep.nombre as nombremadrina FROM madrinaep
                      join feligresesep ON madrinaep.idfeligreses = feligresesep.idfeligres");
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
                    $('#Buscador4').select2();
                    </Script>

                    <div class="form-group">
                    <label >Padrino</label>
                    <select name="idpadrino" id="Buscador5" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT padrinoep.idpadrino as idpadrino, feligresesep.nombre as nombrepadrino FROM padrinoep
                      join feligresesep ON padrinoep.idfeligreses = feligresesep.idfeligres");
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
                    $('#Buscador5').select2();
                    </Script>

                    <div class="form-group">
                    <label >Ministro</label>
                    <select name="idministro" id="Buscador6" class="form-control">
                   
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
                    $('#Buscador6').select2();
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