<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombretestigo'])) {
    $alert = '<p class="alert alert-danger" role="alert">Debe ingresar datos</p>';
  } else {

    $idtestigo = $_POST['id'];
    $nombretestigo = $_POST['nombretestigo'];
        

        $usuario_id = $_SESSION['idUser'];

        $result = 0;

        $sql = "select * from testigo where nombretestigo='$nombretestigo'";
        $result = mysqli_query($conexion, $sql);



       

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
    } else {
    
      $sql_update = mysqli_query($conexion, "UPDATE testigo SET nombretestigo = '$nombretestigo' WHERE idtestigo = $idtestigo");

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
  header("Location: lista_testigo.php");
}
$idtestigo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM testigo WHERE idtestigo = $idtestigo");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_testigo.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idtestigo = $data['idtestigo'];
    $nombretestigo = $data['nombretestigo'];
    
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_testigo.php" class="btn btn-primary">Ver listado de registros</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idtestigo; ?>">
               
            
                <div class="form-group">
                    <label for="nombretestigo">Nombre del testigo</label>
                    <input type="text" placeholder="Ingrese nombre del testigo" name="nombretestigo" id="nombretestigo" class="form-control" value="<?php echo $nombretestigo; ?>">
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