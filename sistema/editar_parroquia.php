<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombreparroquia'])) {
    $alert = '<p class="alert alert-danger" role="alert">Debe ingresar datos</p>';
  } else {

    $idparroquia = $_POST['id'];
    $nombreparroquia = $_POST['nombreparroquia'];
        

        $usuario_id = $_SESSION['idUser'];

        $result = 0;

        $sql = "select * from parroquia where nombreparroquia='$nombreparroquia'";
        $result = mysqli_query($conexion, $sql);



       

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
    } else {
    
      $sql_update = mysqli_query($conexion, "UPDATE parroquia SET nombreparroquia = '$nombreparroquia' WHERE idparroquia = $idparroquia");

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
  header("Location: lista_parroquia.php");
}
$idparroquia = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM parroquia WHERE idparroquia = $idparroquia");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_parroquia.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idparroquia = $data['idparroquia'];
    $nombreparroquia = $data['nombreparroquia'];
    
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_parroquia.php" class="btn btn-primary">Ver listado de registros</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idparroquia; ?>">
               
            
                <div class="form-group">
                    <label for="nombreparroquia">Nombre del parroquia</label>
                    <input type="text" placeholder="Ingrese nombre de la parroquia" name="nombreparroquia" id="nombreparroquia" class="form-control" value="<?php echo $nombreparroquia; ?>">
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