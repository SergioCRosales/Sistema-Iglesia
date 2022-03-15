<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h4 mb-0 text-gray-800">Listado de registros Matrimonio (Esposos de esta parroquia)</h1>
		<a href="registro_matrimoniomixtoh.php" class="btn btn-primary">Nuevo registro</a>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="lista_matrimoniomixtom.php" class="btn btn-primary">Lista esposas</a>
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
						m.idmatrimonio, 
						f.cui as cuiesposo,
						f.nombre as esposo,
						f2.cui as cuiesposa,
						f2.nombre as esposa,
						m.partida,
						m.folio,
						m.libro
						FROM matrimoniocombh as m
						JOIN bautismo as b on m.idbautismo = b.idbautismo
						JOIN feligreses as f on b.idfeligres = f.idfeligres
						JOIN feligresesep as f2 on m.idfeligres = f2.idfeligres
					
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
									<a target='_blank' href="constancia_matrimonioh.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_matrimonioh.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
									</td>
									<td> 
										<form action="eliminar_matrimonioh.php?id=<?php echo $data['idmatrimonio']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td> 

									<?php } 
									 else  { ?>
										<td> 
									<a target='_blank' href="constancia_matrimonioh.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-successp"><i class='fas fa-print'></i></a>
									</td>
									<td> 
										<a href="editar_matrimonioh.php?id=<?php echo $data['idmatrimonio']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
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