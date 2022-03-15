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
							<th>PARTIDA</th>
							<th>FOLIO</th>
							<th>LIBRO</th>
							<th>FECHA BAUTISMO</th>
							<th>LUGAR</th>
							<?php 
							if ($_SESSION['rol'] == 1) { 
							echo '
							
							<th>IMPRIMIR</th>
							<th>IMPRIMIR</th>
							<th>IMPRIMIR</th>
							<th>EDITAR</th>
							<th>ELIMINAR</th>
							';
							}else{
								echo '
							
								<th>IMPRIMIR</th>
								<th>IMPRIMIR</th>
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
						$query = mysqli_query($conexion, "SELECT bautismo.idbautismo, feligreses.cui as cui, 
						feligreses.nombre as nombre,
						bautismo.partida as partida,
						bautismo.folio as folio,
						bautismo.libro as libro,
						bautismo.fecha as fecha,
						lugar.nombrelugar as lugar
						FROM bautismo 
						JOIN feligreses ON bautismo.idfeligres = feligreses.idfeligres
						JOIN lugar ON feligreses.idlugar = lugar.idlugar
						");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cui']; ?></td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['partida']; ?></td>
									<td><?php echo $data['folio']; ?></td>
									<td><?php echo $data['libro']; ?></td>
									<td><?php echo $data['fecha']; ?></td>
									<td><?php echo $data['lugar']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									<td> 
									<a target='_blank' href="cita_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
									<a target='_blank' href="constancia_bautismo2.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
									<a target='_blank' href="constancia_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_bautismoprueba.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_bautismo.php?id=<?php echo $data['idbautismo']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="cita_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
									<a target='_blank' href="constancia_bautismo2.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
									<a target='_blank' href="constancia_bautismo.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_bautismoprueba.php?id=<?php echo $data['idbautismo']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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