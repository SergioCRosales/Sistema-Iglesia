<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombretestiga'])) {
    $alert = '<p class="alert alert-danger" role="alert">Debe ingresar datos</p>';
  } else {

    $idtestiga = $_POST['id'];
    $nombretestiga = $_POST['nombretestiga'];
        

        $usuario_id = $_SESSION['idUser'];

        $result = 0;

        $sql = "select * from testiga where nombretestiga='$nombretestiga'";
        $result = mysqli_query($conexion, $sql);



       

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
    } else {
    
      $sql_update = mysqli_query($conexion, "UPDATE testiga SET nombretestiga = '$nombretestiga' WHERE idtestiga = $idtestiga");

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
  header("Location: lista_testiga.php");
}
$idtestiga = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM testiga WHERE idtestiga = $idtestiga");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_testiga.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idtestiga = $data['idtestiga'];
    $nombretestiga = $data['nombretestiga'];
    
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_testiga.php" class="btn btn-primary">Ver listado de registros</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idtestiga; ?>">
               
            
                <div class="form-group">
                    <label for="nombretestiga">Nombre del testiga</label>
                    <input type="text" placeholder="Ingrese nombre del testiga" name="nombretestiga" id="nombretestiga" class="form-control" value="<?php echo $nombretestiga; ?>">
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