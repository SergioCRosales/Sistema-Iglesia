<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de registros de municipios</h1>
		<a href="registro_municipio.php" class="btn btn-primary">Nuevo registro</a>
	</div>

	<div  align='center' class="row">
    

        <a class="col-xl-3 col-md-6 mb-4" href="lista_lugar.php">
			<div class="card border-left-primary shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div align='center' class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h5>Listado registros lugares</h5></div>
                            
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_departamento.php">
			<div class="card border-left-success shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h5>Listado registros departamentos<h5></div>
							
							
						</div>
						
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_parroquia.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h5>Listado registros parroquias</h5></div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
							
								
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</a>

        <a class="col-xl-3 col-md-6 mb-4" href="lista_ministro.php">
			<div class="card border-left-info shadow h-100 py-0">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h5>Listado registros ministros</h5></div>
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

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>NUMERO</th>
							<th>NOMBRE DEL MUNICIPIO</th>
							
							<?php 
							if ($_SESSION['rol'] == 1) { 
							echo '
							
							
							<th>EDITAR</th>
							<th>ELIMINAR</th>
							';
							}else{
								echo '
							
								
								<th>EDITAR</th>
								';

							}
							
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";
						$query = mysqli_query($conexion, "SELECT * FROM municipio");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['idmunicipio']; ?></td>
									<td><?php echo $data['nombremunicipio']; ?></td>
									
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									
									<td> 
										<a href="editar_municipio.php?id=<?php echo $data['idmunicipio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_municipio.php?id=<?php echo $data['idmunicipio']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
									
									<td> 
										<a href="editar_municipio.php?id=<?php echo $data['idmunicipio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									


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