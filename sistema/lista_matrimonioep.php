<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Registros Matrimonio (Originarios de otra parroquia)</h1>
		<a href="registro_matrimonioep.php" class="btn btn-primary">Nuevo registro</a>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_matrimonio.php" class="btn btn-primary">Originario de esta parroquia</a>
    </div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							
							<th>CUI ESPOSO</th>
							<th>NOMBRE ESPOSO </th>
							<th>CUI ESPOSA</th>
							<th>NOMBRE ESPOSA </th>
							<th>PARTIDA</th>
							<th>FOLIO</th>
							<th>LIBRO</th>
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
						$query = mysqli_query($conexion, "SELECT
						m1.idmatrimonio,
						f1.cui as cuiesposo,
						f1.nombre as esposo,
						f2.cui as cuiesposa,
						f2.nombre as esposa,
						m1.partida as partida,
						m1.folio as folio,
						m1.libro as libro,
						m1.fecha as fecha
						FROM matrimonioep as m1
						JOIN feligresesep as f1 on m1.idfeligres = f1.idfeligres
						JOIN feligresesep as f2 on m1.idfeligres2 = f2.idfeligres
					
						" );

						
						$result = mysqli_num_rows($query);
					
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['cuiesposo']; ?></td>
									<td><?php echo $data['esposo']; ?></td>
									<td><?php echo $data['cuiesposa']; ?></td>
									<td><?php echo $data['esposa']; ?></td>
									<td><?php echo $data['partida']; ?></td>
									<td><?php echo $data['folio']; ?></td>
									<td><?php echo $data['libro']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
                                    
									<td> 
									<a target='_blank' href="constancia_matrimonioep.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_matrimonioep.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_matrimonioep.php?id=<?php echo $data['idmatrimonio']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="constancia_matrimonioep.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_matrimonioep.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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