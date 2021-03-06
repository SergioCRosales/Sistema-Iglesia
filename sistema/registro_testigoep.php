<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['idfeligreses'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
    
        $idfeligreses = $_POST['idfeligreses'];
       

        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($idfeligreses) and $idfeligreses != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM testigoep where idfeligreses = '$idfeligreses'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El registro de la testigo ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO testigoep(idfeligreses) values ('$idfeligreses')");
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
    
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seleccione datos testigo (Originario de otra parroquia)</h1>
        <a href="lista_testigoep.php" class="btn btn-primary">Ver registros testigos</a>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="registro_testigo2.php" class="btn btn-primary">Originaria de esta parroquia</a>
    
    </div>

    <br>

    <div  align='center' class="row">

        
    <a class="col-xl-1 col-md-6 mb-4" >
			
		</a>
    

        <a class="col-xl-2 col-md-6 mb-4" href="registro_madreep.php">
			<div class="card border-left-primary shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div align='center' class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h6>Ingresar datos madre</h6></div>
                            
						</div>
						
					</div>
				</div>
			</div>
		</a>
        

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-2 col-md-6 mb-4" href="registro_padreep.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6>Ingresar datos padre<h6></div>
							
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-2 col-md-6 mb-4" href="registro_madrinaep.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6>Ingresar datos madrina</h6></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-2 col-md-6 mb-4" href="registro_padrinoep.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6>Ingresar datos del padrino</h6></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

       
        <a class="col-xl-2 col-md-6 mb-4" href="registro_testigaep.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6>Ingresar datos de la testigo<h6></div>
							
							
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
                <br></br>
                <div class="form-group">
                    <label >Seleccione nombre testigo</label>
                    <select name="idfeligreses" id="Buscador" class="form-control">
                    
                    <?php
                      $categoriac= mysqli_query($conexion, "SELECT * FROM feligresesep");
                                        while($catec=mysqli_fetch_array($categoriac, MYSQLI_ASSOC)){
                                            echo '<option value="'.$catec['idfeligreses'].'">'.$catec['nombre'].' || '.$catec['cui'].'</option>';
                                        }
                    ?>
                    </select></div>
                    <Script>
                    $('#Buscador').select2();
                    </Script>
                    <br></br>

                <input type="submit" value="A??adir a registros de testigos" class="btn btn-primary">
            </form>
        </div>
    </div>


      
    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>