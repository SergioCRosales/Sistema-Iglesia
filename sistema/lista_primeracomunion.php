<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Listado de registros Primera Comunion</h1>
		<a href="registro_primeracomunion.php" class="btn btn-primary">Nuevo registro</a>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_primeracomunionep.php" class="btn btn-primary">Originario de otra parroquia</a>
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
							<th>FECHA</th>
							<th>LUGAR</th>
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
						$query = mysqli_query($conexion, "SELECT comunion.idcomunion, feligreses.cui as cui, 
						feligreses.nombre as nombre,
						comunion.partidacm as partida,
						comunion.foliocm as folio,
						comunion.librocm as libro,
						comunion.fecha as fecha,
						lugar.nombrelugar as lugar
						FROM comunion 
						JOIN bautismo ON comunion.idbautismo = bautismo.idbautismo
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
									<a target='_blank' href="constancia_comunion.php?id=<?php echo $data['idcomunion']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_primeracomunion.php?id=<?php echo $data['idcomunion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_primeracomunion.php?id=<?php echo $data['idcomunion']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="constancia_comunion.php?id=<?php echo $data['idcomunion']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_primeracomunion.php?id=<?php echo $data['idcomunion']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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