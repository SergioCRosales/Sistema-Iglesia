<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['parroquia'])) {
    $alert = '<p class="alert alert-danger" role="alert">Todo los campos son requeridos</p>';
  } else {
    $idconfiguracion = $_POST['id'];
    
    $parroquia = $_POST['parroquia'];
    $municipio = $_POST['municipio'];
    $departamento = $_POST['departamento'];
    $diocesis = $_POST['diocesis'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    
   
    $result = 0;
    if (is_numeric($idconfiguracion) and $idconfiguracion != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM configuracion where idconfiguracion != '$idconfiguracion'");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El registro ya existe</p>';
    } else {
      if ($idconfiguracion == '') {
        $idconfiguracion = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE configuracion SET  idconfiguracion = $idconfiguracion, parroquia = '$parroquia', municipio = '$municipio', departamento = '$departamento', diocesis = '$diocesis', telefono = '$telefono', direccion = '$direccion'  WHERE idconfiguracion = $idconfiguracion");
   
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
  header("Location: lista_feligreses.php");
}
$idconfiguracion = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM configuracion WHERE idconfiguracion = $idconfiguracion");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_feligreses.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idconfiguracion = $data['idconfiguracion'];
  

    $parroquia = $data['parroquia'];
    $municipio = $data['municipio'];
    $departamento = $data['departamento'];
    $diocesis = $data['diocesis'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
   

  }
}


?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        
        <h1 class="h3 mb-0 text-gray-800">Datos ingresados de la  Parroquia</h1>
        
    </div>
    <br></br>
  
          <div class="row">
            <div class="col-lg-6 m-auto">


              <form class="" action="" method="post">
            
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idconfiguracion; ?>">
               
                
                <div class="form-group">
                    <label for="parroquia">Nombre de la Parroquia</label>
                    <input type="text" placeholder="Ingrese nombre de parroquia" name="parroquia" id="parroquia" class="form-control" 
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){1,12}$"
                    title="El nombre de la parroquia solo debe contener letras y debe de estar completo"
                    value="<?php echo $parroquia; ?>">
                </div>
                <div class="form-group">
                    <label for="municipio">Nombre del Municipio</label>
                    <input type="text" placeholder="Ingrese nombre del Municipio" name="municipio" id="municipio" class="form-control" 
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){1,12}$"
                    title="El nombre del municipio solo debe contener letras y debe de estar completo"
                    value="<?php echo $municipio; ?>">
                </div>
                <div class="form-group">
                    <label for="departamento">Nombre de la Departamento</label>
                    <input type="text" placeholder="Ingrese nombre del Departamento" name="departamento" id="departamento" class="form-control" 
                    required pattern="^([A-ZÁÄÉËÍÏÓÖÚÜÑ]{1}[a-záäéëíïóöúüñ]+[ ]?){1,12}$"
                    title="El nombre del departamento solo debe contener letras y debe de estar completo"
                    value="<?php echo $departamento; ?>">
                </div>
                <div class="form-group">
                    <label for="diocesis">Nombre de la diocesis</label>
                    <input type="text" placeholder="Ingrese numero de diocesis" name="diocesis" id="diocesis" class="form-control" 
                   
                    value="<?php echo $diocesis; ?>">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" placeholder="Ingrese numero telefono" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>">
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <textarea name="direccion" class="form-control" ><?php echo $direccion;?></textarea>
                   
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