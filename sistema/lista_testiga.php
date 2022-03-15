<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de registros de las testigos (mujeres)</h1>
		<a href="registro_testiga2.php" class="btn btn-primary">Nuevo registro</a>
	</div>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_testigaep.php" class="btn btn-primary">Originaria de otra parroquia</a>
    </div>


	<div  align='center' class="row">

        
    <a class="col-xl-1 col-md-6 mb-4" >
			
		</a>
    

        <a class="col-xl-2 col-md-6 mb-4" href="lista_madre.php">
			<div class="card border-left-primary shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div align='center' class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h6>Ver registros madres</h6></div>
                            
						</div>
						
					</div>
				</div>
			</div>
		</a>
        

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-2 col-md-6 mb-4" href="lista_padre.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6>Ver registros padres<h6></div>
							
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-2 col-md-6 mb-4" href="lista_madrina.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6>Ver registros madrinas</h6></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-2 col-md-6 mb-4" href="lista_padrino.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6>Ver registros padrinos</h6></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

       
        <a class="col-xl-2 col-md-6 mb-4" href="lista_testigo.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6>Ver registros testigos<h6></div>
							
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		
	</div>

	<br>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>CUI</th>
							<th>NOMBRE DE LA TESTIGO</th>
							
							<?php 
							if ($_SESSION['rol'] == 1) { 
							echo '
							
							
							
							<th>ELIMINAR</th>
							';
							}else{
								echo '
							
								
								
								';

							}
							
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";
						$query = mysqli_query($conexion, "SELECT testiga.idtestiga, feligreses.nombre as nombretestiga, feligreses.cui as cui FROM testiga
						join feligreses ON testiga.idfeligres = feligreses.idfeligres");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cui']; ?></td>
									<td><?php echo $data['nombretestiga']; ?></td>
									
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									
									
									<td> 
										<form action="eliminar_testiga.php?id=<?php echo $data['idtestiga']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
									
									
									


									<?php } ?>

									

								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>