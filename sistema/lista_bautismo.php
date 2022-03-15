<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de registros de Bautismo</h1>
		<a href="registro_bautismo.php" class="btn btn-primary">Nuevo registro</a>
	</div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>CUI</th>
							<th>NOMBRE BAUTIZADO</th>
							<th>LIBRO</th>
							<th>FECHA BAUTISMO</th>
							<th>FECHA NACIMIENTO</th>
							<th>DIRECCIÓN</th>
							<?php 
							if ($_SESSION['rol'] == 1) { 
							echo '
							
							<th>IMPRIMIR</th>
							<th>EDITAR</th>
							<th>ELIMINAR</th>
							';
							}else{
								echo '
							
								<th>IMPRIMIR</th>
								<th>EDITAR</th>
								';

							}
							
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";
						$query = mysqli_query($conexion, "SELECT * FROM bautismos");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cui']; ?></td>
									<td><?php echo $data['bautizado']; ?></td>
									<td><?php echo $data['libro']; ?></td>
									<td><?php echo $data['fecha']; ?></td>
									<td><?php echo $data['fecha_nacimiento']; ?></td>
									<td><?php echo $data['lugar']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									<td> 
									<a target='_blank' href="print.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_bautismo.php?id=<?php echo $data['idbautismo']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="print.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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