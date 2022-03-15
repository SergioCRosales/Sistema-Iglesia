<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Registros Confirmacion (Originarios de otras parroquias)</h1>
		<a href="registro_confirmacionep.php" class="btn btn-primary">Nuevo registro</a>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_confirmacion.php" class="btn btn-primary">Originario de esta parroquia</a>
    </div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>CUI</th>
							<th>NOMBRE </th>
							<th>PARTIDA</th>
							<th>FOLIO</th>
							<th>LIBRO</th>
							<th>LUGAR</th>
							<th>PARROQUIA</th>
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
						$query = mysqli_query($conexion, "SELECT confirmacionep.idconfirmacion, feligresesep.cui as cui, 
						feligresesep.nombre as nombre,
						confirmacionep.partida as partida,
						confirmacionep.folio as folio,
						confirmacionep.libro as libro,
						confirmacionep.fecha as fecha,
						lugar.nombrelugar as lugar,
						parroquia.nombreparroquia as parroquia
						FROM confirmacionep 
						JOIN feligresesep ON confirmacionep.idfeligres = feligresesep.idfeligres
						JOIN lugar ON feligresesep.idlugar = lugar.idlugar
						JOIN parroquia ON feligresesep.idparroquia = parroquia.idparroquia");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cui']; ?></td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['partida']; ?></td>
									<td><?php echo $data['folio']; ?></td>
									<td><?php echo $data['libro']; ?></td>
									<td><?php echo $data['lugar']; ?></td>
									<td><?php echo $data['parroquia']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									<td> 
									<a target='_blank' href="constancia_confirmacionep.php?id=<?php echo $data['idconfirmacion']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_confirmacionep.php?id=<?php echo $data['idconfirmacion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_confirmacionep.php?id=<?php echo $data['idconfirmacion']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="constancia_confirmacionep.php?id=<?php echo $data['idconfirmacion']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_confirmacionep.php?id=<?php echo $data['idconfirmacion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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