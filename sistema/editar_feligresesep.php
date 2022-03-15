<?php include_once "includes/header.php";
include "../conexion.php";
ini_set('display_errors',0);
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idfeligres = $_POST['id'];

    $cui = $_POST['cui'];
    $nombre = $_POST['nombre'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $iddepartamento = $_POST['iddepartamento'];
    $idmunicipio = $_POST['idmunicipio'];
    $idlugar = $_POST['idlugar'];
    $idparroquia = $_POST['idparroquia'];

    if(empty( $_POST['opcion1'])){
      $opcion1 = 0;
  }else{
      $opcion1 = $_POST['opcion1'];
  }

  if(empty( $_POST['opcion2'])){
      $opcion2 = 0;
  }else{
      $opcion2 = $_POST['opcion2'];
  }

  if(empty( $_POST['opcion3'])){
      $opcion3 = 0;
  }else{
      $opcion3 = $_POST['opcion3'];
  }

  if(empty( $_POST['opcion4'])){
      $opcion4 = 0;
  }else{
      $opcion4 = $_POST['opcion4'];
  }

  if(empty( $_POST['opcion5'])){
      $opcion5 = 0;
  }else{
      $opcion5 = $_POST['opcion5'];
  }

  if(empty( $_POST['opcion6'])){
      $opcion6 = 0;
  }else{
      $opcion6 = $_POST['opcion6'];
  }
   
    $result = 0;
    if (is_numeric($cui) and $cui != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM feligresesep where (cui = '$cui' AND idfeligres != $idfeligres)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El CUI ya existe</p>';
    } else {
      if ($cui == '') {
        $cui = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE feligresesep SET  cui = $cui, nombre = '$nombre', fechanacimiento = '$fechanacimiento',  iddepartamento = '$iddepartamento', idmunicipio = '$idmunicipio', idlugar = '$idlugar', idparroquia = '$idparroquia', idconfiguracion = '1' WHERE idfeligres = $idfeligres");
   
      if ($sql_update) {
        $alert = '<p class="alert alert-primary" role="alert">Registro actualizado correctamente</p>';

        if($opcion1 === '1'){
          $query_insert1 = mysqli_query($conexion, "INSERT INTO madreep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from madreep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{

        $query_insert1 = mysqli_query($conexion, "DELETE FROM madreep WHERE idfeligreses = '$idfeligres'");

      }

      if($opcion2 === '2'){
          $query_insert2 = mysqli_query($conexion, "INSERT INTO padreep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from padreep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{
        $query_insert1 = mysqli_query($conexion, "DELETE FROM padreep WHERE idfeligreses = '$idfeligres'");
           
      }

      if($opcion3 === '3'){
          $query_insert3 = mysqli_query($conexion, "INSERT INTO madrinaep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from madrinaep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{
        $query_insert1 = mysqli_query($conexion, "DELETE FROM madrinaep WHERE idfeligreses = '$idfeligres'");
      }

      if($opcion4 === '4'){
          $query_insert4 = mysqli_query($conexion, "INSERT INTO padrinoep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from padrinoep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{
        $query_insert1 = mysqli_query($conexion, "DELETE FROM padrinoep WHERE idfeligreses = '$idfeligres'");
      }

      if($opcion5 === '5'){
          $query_insert5 = mysqli_query($conexion, "INSERT INTO testigaep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from testigaep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{
        $query_insert1 = mysqli_query($conexion, "DELETE FROM testigaep WHERE idfeligreses = '$idfeligres'");
      }

      if($opcion6 === '6'){
          $query_insert5 = mysqli_query($conexion, "INSERT INTO testigoep(idfeligreses) SELECT '$idfeligres' 
          FROM DUAL WHERE NOT EXISTS (SELECT idfeligreses 
                                      from testigoep WHERE idfeligreses='$idfeligres' LIMIT 1)");
      }else{
        $query_insert1 = mysqli_query($conexion, "DELETE FROM testigoep WHERE idfeligreses = '$idfeligres'");
      }




      } else {
        $alert = '<p class="alert alert-danger" role="alert">Error al actualizar el registro</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_feligreses.php");
}
$idfeligres = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM feligresesep WHERE idfeligres = $idfeligres");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_feligreses.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idfeligres = $data['idfeligres'];
  
    $cui = $data['cui'];
    $nombre = $data['nombre'];
    $fechanacimiento = $data['fechanacimiento'];
    $iddepartamento = $data['iddepartamento'];
    $idmunicipio = $data['idmunicipio'];
    $idlugar = $data['idlugar'];
    $idparroquia = $data['idparroquia'];
   

    $consultaactual= mysqli_query($conexion,"SELECT * FROM feligresesep WHERE idfeligres='$idfeligres'");
    $actual=mysqli_fetch_array($consultaactual, MYSQLI_ASSOC);


    $consultamadre = mysqli_query($conexion, "SELECT idmadre
    FROM madreep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $cslmadre = mysqli_fetch_array($consultamadre, MYSQLI_ASSOC);

    $consultapadre = mysqli_query($conexion, "SELECT idpadre
    FROM padreep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $cslpadre = mysqli_fetch_array($consultapadre, MYSQLI_ASSOC);

    $consultamadrina = mysqli_query($conexion, "SELECT idmadrina
    FROM madrinaep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $cslmadrina = mysqli_fetch_array($consultamadrina, MYSQLI_ASSOC);

    $consultapadrino = mysqli_query($conexion, "SELECT idpadrino
    FROM padrinoep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $cslpadrino = mysqli_fetch_array($consultapadrino, MYSQLI_ASSOC);

    $consultatestiga = mysqli_query($conexion, "SELECT idtestiga
    FROM testigaep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $csltestiga = mysqli_fetch_array($consultatestiga, MYSQLI_ASSOC);

    $consultatestigo = mysqli_query($conexion, "SELECT idtestigo
    FROM testigoep m
    JOIN feligresesep f on m.idfeligreses = f.idfeligres
    WHERE f.idfeligres='$idfeligres'");

    $csltestigo = mysqli_fetch_array($consultatestigo, MYSQLI_ASSOC);
    
    



  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar datos del feligres (Originario de otras parroquia)</h1>
       
        <a href="lista_feligresesep.php" class="btn btn-primary">Ver listado feligreses</a>
    </div>
 

          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idfeligres; ?>">
               
                
                <div class="form-group">
                    <label for="cui">CUI</label>
                    <input type="text" placeholder="Ingrese numero de cui" name="cui" id="cui" class="form-control" maxlength="13"
                    pattern="^[1-9]{1}[0-9]{12}$"
                    title="Verifique el CUI si esta completo o bien ingresado" 
                    value="<?php echo $cui; ?>">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre feligres</label>
                    <input type="text" placeholder="Ingrese numero de nombre" name="nombre" id="nombre" class="form-control" 
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){2,8}$"
                    title="El nombre solo debe contener letras y debe de estar completo"
                    value="<?php echo $nombre; ?>">
                </div>
                <div>
                <span>Elija rol (si aplica)</span>
                <br>
                <label><input type="checkbox" value="1" <?php if(!empty($cslmadre)) {echo 'checked="checked"';} ?> name="opcion1" />Madre</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=2  <?php if(!empty($cslpadre)) {echo 'checked="checked"';} ?> name="opcion2" />Padre</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=3  <?php if(!empty($cslmadrina)) {echo 'checked="checked"';} ?> name="opcion3" />Madrina</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=4   <?php if(!empty($cslpadrino)) {echo 'checked="checked"';} ?> name="opcion4" />Padrino</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=5  <?php if(!empty($csltestiga)) {echo 'checked="checked"';} ?> name="opcion5" />Testiga</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <label><input type="checkbox" value=6  <?php if(!empty($csltestigo)) {echo 'checked="checked"';} ?> name="opcion6" />Testigo</label>
                </div>
                <div class="form-group">
                    <label for="fechanacimiento">Fecha nacimiento</label>
                    <input type="date" placeholder="Ingrese fechanacimiento nacimiento del bautizado" name="fechanacimiento" id="fechanacimiento" class="form-control" value="<?php echo $fechanacimiento; ?>"  required pattern="">
                </div>
                <div class="form-group">
                    <label >Departamento</label>
                    <select id="Buscador" name="iddepartamento"  class="form-control">
                   
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
                    <label >Municipio</label>
                    <select id="Buscador2" name="idmunicipio"  class="form-control">
                   
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
                    <label >Lugar de origen</label>
                    <select id="Buscador3" name="idlugar"  class="form-control">
                   
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
                    <label >Parroquia</label>
                    <select id="Buscador4" name="idparroquia"  class="form-control">
                   
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM parroquia");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                          if($actual['idparroquia']==$catec['idparroquia']){
                                            echo '<option selected="" value="'.$catec['idparroquia'].'">'.$catec['nombreparroquia'].' (Actual)</option>';
                                        }else{
                                          echo '<option value="'.$catec['idparroquia'].'">'.$catec['nombreparroquia'].'</option>';
                                        }
                                      }
                    ?>

                    </select></div>

                    <Script>
                    $('#Buscador').select2();
                    </Script>
                    <Script>
                    $('#Buscador2').select2();
                    </Script>
                    <Script>
                    $('#Buscador3').select2();
                    </Script>
                    <Script>
                    $('#Buscador4').select2();
                    </Script>
                    
                
        
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Registro</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include_once "includes/footer.php"; ?>