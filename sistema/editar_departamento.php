<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombredepartamento'])) {
    $alert = '<p class="alert alert-danger" role="alert">Debe ingresar datos</p>';
  } else {

    $iddepartamento = $_POST['id'];
    $nombredepartamento = $_POST['nombredepartamento'];
        

        $usuario_id = $_SESSION['idUser'];

        $result = 0;

        $sql = "select * from departamento where nombredepartamento='$nombredepartamento'";
        $result = mysqli_query($conexion, $sql);



       

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
    } else {
    
      $sql_update = mysqli_query($conexion, "UPDATE departamento SET nombredepartamento = '$nombredepartamento' WHERE iddepartamento = $iddepartamento");

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
  header("Location: lista_departamento.php");
}
$iddepartamento = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM departamento WHERE iddepartamento = $iddepartamento");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_departamento.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $iddepartamento = $data['iddepartamento'];
    $nombredepartamento = $data['nombredepartamento'];
    
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
         <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="lista_departamento.php" class="btn btn-primary">Ver listado de registros</a>
    </div>

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $iddepartamento; ?>">
               
            
                <div class="form-group">
                    <label for="nombredepartamento">Nombre del departamento</label>
                    <input type="text" placeholder="Ingrese nombre del departamento" name="nombredepartamento" id="nombredepartamento" class="form-control" value="<?php echo $nombredepartamento; ?>">
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