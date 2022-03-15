<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombremunicipio']))  {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Debe ingresar el nombre del municipio
                                </div>';
    } else {
    
        $nombre = $_POST['nombremunicipio'];
        $usuario_id = $_SESSION['idUser'];
        $result = 0;
        $sql = "select * from municipio where nombremunicipio='$nombre'";
        $result = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($result)>0)
        {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El nombre ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO municipio(nombremunicipio) values ('$nombre')");
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
        <h1 class="h3 mb-0 text-gray-800">Ingresar datos nuevo municipio</h1>
        <a href="registro_feligreses.php" class="btn btn-primary">Registrar feligres</a>
    </div>

    <div  align='center' class="row">
    

		<!-- Earnings (Monthly) Card Example -->
		

        <a class="col-xl-3 col-md-6 mb-4" href="registro_lugar.php">
			<div class="card border-left-primary shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div align='center' class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h5>Ingresar datos <br> lugar</h5></div>
                           
						
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_departamento.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h5>Ingresar datos departamento<h5></div>
							
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="registro_parroquia.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h5>Ingresar datos parroquias</h5></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-3 col-md-6 mb-4" href="registro_ministro.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h5>Ingresar datos ministro</h5></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		
	</div>

   

    

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                <br></br>
                    <label for="nombremunicipio">Nombre de municipio</label>
                    <input type="text" placeholder="Ingrese nombre de municipio" name="nombremunicipio" id="nombremunicipio" class="form-control">
                </div>
                <br>

                <input type="submit" value="Guardar registro municipio" class="btn btn-primary">
            </form>
        </div>
    </div>


      
    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>