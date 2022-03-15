<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombretestigo']))  {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Debe ingresar el nombre del testigo
                                </div>';
    } else {
    
        $nombre = $_POST['nombretestigo'];
        

        $usuario_id = $_SESSION['idUser'];

        $result = 0;

        $sql = "select * from testigo where nombretestigo='$nombre'";
        $result = mysqli_query($conexion, $sql);



       

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO testigo(nombretestigo) values ('$nombre')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    Registro guardado!
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ingrese nombre del testigo (hombre)</h1>
        <a href="registrar_matrimonio.php" class="btn btn-primary">Registrar matrimonio</a>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_madre.php" class="btn btn-primary">Ingresar datos madre</a>
        <a href="registro_padre.php" class="btn btn-primary">Ingresar datos padre</a>
        <a href="registro_madrina.php" class="btn btn-primary">Ingresar datos madrina</a>
        <a href="registro_padrino.php" class="btn btn-primary">Ingresar datos padrino</a>
        <a href="registro_testiga.php" class="btn btn-primary">Ingresar datos de la testigo</a>
       
        
    </div>

    

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                <br></br>
                    <label for="nombretestigo">Nombre de la testigo</label>
                    <input type="text" placeholder="Ingrese nombre del testigo" name="nombretestigo" id="nombretestigo" class="form-control">
                </div>
                

                <input type="submit" value="Guardar registro del testigo" class="btn btn-primary">
            </form>
        </div>
    </div>


      
    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>