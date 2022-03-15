<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de feligreses</h1>
		<a href="registro_feligreses.php" class="btn btn-primary">Nuevo registro</a>
	</div>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_feligresesep.php" class="btn btn-primary">Originario de otra parroquia</a>
    </div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>CUI</th>
							<th>NOMBRE FELIGRES</th>
							<th>FECHA NACIMIENTO</th>
							<th>LUGAR</th>
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
						$query = mysqli_query($conexion, "SELECT f.idfeligres, f.cui as cui, 
						f.nombre as nombre,
						f.fechanacimiento as fecha,
						l.nombrelugar as lugar
						FROM feligreses as f
						JOIN lugar as l on f.idlugar = l.idlugar
						");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cui']; ?></td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['fecha']; ?></td>
									<td><?php echo $data['lugar']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									
									<td> 
										<a href="editar_feligreses.php?id=<?php echo $data['idfeligres']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_feligres.php?id=<?php echo $data['idfeligres']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										
									<td> 
										<a href="editar_feligreses.php?id=<?php echo $data['idfeligres']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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