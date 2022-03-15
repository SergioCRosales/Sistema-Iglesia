<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['idbautismo'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idmatrimonio = $_POST['id'];
  
    $partida = $_POST['partida'];
    $folio = $_POST['folio'];
    $libro = $_POST['libro'];
    $fecha = $_POST['fecha'];
    $idtestiga = $_POST['idtestiga'];
    $idtestigo = $_POST['idtestigo'];
    $idbautismo = $_POST['idbautismo'];
    $edadesposo = $_POST['edadesposo'];
    $idbautismo2 = $_POST['idbautismo2'];
    $edadesposa = $_POST['edadesposa'];
    $idministro = $_POST['idministro'];
    $observaciones = $_POST['observaciones'];
    

    $result = 0;
    if (is_numeric($idbautismo) and $idbautismo != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM matrimonio where (idbautismo = '$idbautismo' AND idmatrimonio != $idmatrimonio)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class="alert alert-danger" role="alert">El matrimonio ya habia sido registrado</p>';

      ?> <a target='_blank' href="constancia_matrimonio.php?id=<?php echo $result['idmatrimonio']; ?>">
      <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 

    } else {
      if ($idbautismo == '') {
        $idbautismo = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE matrimonio SET  partida = $partida, folio = '$folio', libro = '$libro', fecha = '$fecha', idtestiga = '$idtestiga', idtestigo = '$idtestigo', idbautismo = '$idbautismo', edadesposo = '$edadesposo', idbautismo2 = '$idbautismo2', edadesposa = '$edadesposa', idministro = '$idministro', observaciones = '$observaciones' WHERE idmatrimonio = $idmatrimonio");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';

        $result2 = 0;
        if (is_numeric($idbautismo) and $idbautismo != 0) {
            $query2 = mysqli_query($conexion, "SELECT * FROM matrimonio where idbautismo = '$idbautismo'");
            $result2 = mysqli_fetch_array($query2);
        }
        ?> <a target='_blank' href="constancia_matrimonio.php?id=<?php echo $result2['idmatrimonio']; ?>">
        <div align="center"> <img height="110" width="115" src="img/imprimir.jpg"><h4>Imprimir</h4> </div></a> <?php 

      } else {
        $alert = '<p class="alert alert-danger" role="alert">Error al actualizar el registro</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_matrimonio.php");
}
$idmatrimonio = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM matrimonio WHERE idmatrimonio = $idmatrimonio");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_matrimonio.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idmatrimonio = $data['idmatrimonio'];
    $partida = $data['partida'];
    $folio = $data['folio'];
    $libro = $data['libro'];
    $fecha = $data['fecha'];
    $idtestiga = $data['idtestiga'];
    $idtestigo = $data['idtestigo'];
    $idbautismo = $data['idbautismo'];
    $edadesposo = $data['edadesposo'];
    $idbautismo2 = $data['idbautismo2'];
    $edadesposa = $data['edadesposa'];
    $idministro = $data['idministro'];
    $observaciones = $data['observaciones'];

    $consultaactual= mysqli_query($conexion,"SELECT * FROM matrimonio WHERE idmatrimonio='$idmatrimonio'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);
  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Editar datos de constancia de Matrimonio</h1>
       
        <a href="lista_matrimonio.php" class="btn btn-primary">Ver listado matrimonio</a>
    </div>
 

          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idmatrimonio; ?>">
               
                
                <div class="form-group">
                    <label for="partida">No. Partida</label>
                    <input type="number" placeholder="Ingrese numero de partida" name="partida" id="partida" class="form-control"  required pattern="^[0-9]{10}$" value="<?php echo $partida; ?>">
                </div>
                <div class="form-group">
                    <label for="folio">No. Folio</label>
                    <input type="number" placeholder="Ingrese numero de folio" name="folio" id="folio" class="form-control"  required pattern="^[0-9]{10}$" value="<?php echo $folio; ?>">
                </div>
                <div class="form-group">
                    <label for="libro">No. Libro</label>
                    <input type="number" placeholder="Ingrese numero de libro" name="libro" id="libro" class="form-control"  required pattern="^[0-9]{10}$" value="<?php echo $libro; ?>">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha del matrimonio</label>
                    <input type="date" placeholder="Ingrese fecha nacimiento del bautizado" name="fecha" id="fecha" class="form-control"  required pattern="" value="<?php echo $fecha; ?>">
                </div>


                <div class="form-group">
                    <label >Nombre de la testigo</label>
                    <select name="idtestiga" id="Buscador" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT testiga.idtestiga as idtestiga, feligreses.nombre as nombre FROM testiga
                      join feligreses ON testiga.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idtestiga']==$catec['idtestiga']){
                                            echo '<option selected="" value="'.$catec['idtestiga'].'">'.$catec['nombre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idtestiga'].'">'.$catec['nombre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>

                    <div class="form-group">
                    <label >Nombre del testigo</label>
                    <select name="idtestigo" id="Buscador2" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT testigo.idtestigo as idtestigo, feligreses.nombre as nombre FROM testigo
                      join feligreses ON testigo.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idtestigo']==$catec['idtestigo']){
                                            echo '<option selected="" value="'.$catec['idtestigo'].'">'.$catec['nombre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idtestigo'].'">'.$catec['nombre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>

                    <div class="form-group">
                    <label >Nombre del esposo</label>
                    <select name="idbautismo" id="Buscador3" class="form-control">
                   
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
                    $('#Buscador3').select2();
                    </Script>

                <div class="form-group">
                    <label for="edadesposo">Edad del esposo</label>
                    <input type="number" placeholder="Ingrese edad del esposo" name="edadesposo" id="edadesposo" class="form-control"  
                    value="<?php echo $edadesposo; ?>"
                    required pattern="^[1-9]{1}[0-9]{2}$" 
                    title="Verifique la edad"
                    >
                </div>

                <div class="form-group">
                    <label >Nombre de la esposa</label>
                    <select name="idbautismo2" id="Buscador4" class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT bautismo.idbautismo as idbautismo2, feligreses.nombre as nombre FROM bautismo 
                      join feligreses on bautismo.idfeligres = feligreses.idfeligres");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idbautismo2']==$catec['idbautismo2']){
                                            echo '<option selected="" value="'.$catec['idbautismo2'].'">'.$catec['nombre'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idbautismo2'].'">'.$catec['nombre'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>
                    <Script>
                    $('#Buscador4').select2();
                    </Script>

                <div class="form-group">
                    <label for="edadesposa">Edad de la esposa</label>
                    <input type="number" placeholder="Ingrese edad de la esposa" name="edadesposa" id="edadesposa" class="form-control"  
                    required pattern="^[1-9]{1}[0-9]{2}$" 
                    title="Verifique la edad"
                    value="<?php echo $edadesposa; ?>">
                </div>

                  

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